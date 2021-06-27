<?php

namespace App\Exceptions;

use App\Traits\HttpResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Throwable;

/**
 * Class Handler
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    use HttpResponse;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Throwable $exception
     * @return void
     *
     * @throws Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     * Handle exception types and build convenience response to clients
     *
     * @param Request $request
     * @param Throwable $exception
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        #sentry
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        if ($exception instanceof MethodNotAllowedException) {
            return $this->sendErrorResponse([], 'Method not allowed', 405);
        }

        if ($exception instanceof CustomValidatorException) {
            return $this->sendErrorResponse($exception->getErrors(), 'Required fields are missing', 422);
        }

        if ($request->wantsJson()) {
            //Unauthenticated
            if ($exception instanceof AuthenticationException) {
                return $this->sendErrorResponse(null, $exception->getMessage(), 401);
            }


            $code = $exception->getCode() ?: 500;


            if (config('app.debug')) {
                $response = $exception->getMessage();
                $debug = $exception->getTrace();
                $message = $exception->getMessage();

                if ($exception instanceof QueryException) {
                    $code = 500;
                }

                return $this->sendErrorResponse(
                    null,
                    $response,
                    $code,
                    [],
                    $message,
                    $debug
                );
            } else {
                $message = "Something went wrong, Please try again later.";


                if ($exception instanceof DolphiqException) {
                    return $this->sendErrorResponse([], $exception->getMessage(), $exception->getCode());
                }
                if ($exception instanceof NotFoundHttpException) {
                    return $this->sendErrorResponse([], 'Resource not found', 404);
                }


                if ($exception instanceof QueryException) {
                    $code = 500;
                    $message = "Server Error! Please Try Again.";
                }

                //default
                return $this->sendErrorResponse(
                    null,
                    $message,
                    $code,
                    [],
                    $exception->getMessage()
                );
            }
        }

        return parent::render($request, $exception);
    }
}
