<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use InvalidArgumentException;

/**
 * Trait HttpResponse
 * @package App\Traits
 */
trait HttpResponse
{

    /**
     * @var array
     */
    public static $statusTexts = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Mandatory fields should be validated',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        423 => 'Unknown Error'
    ];
    /**
     * @var string
     */
    public $version;
    /**
     * @var int
     */
    protected $statusCode = 200;
    /**
     * @var string
     */
    protected $statusText;
    /**
     * @var array
     */
    protected $parameters = [];
    /**
     * @var array
     */
    protected $httpHeaders = [];

    /**
     * Send API Response
     *
     * @param array | Collection $data
     * @param string $message
     * @param int $statusCode
     * @param array $headers
     *
     * @param null $statusText
     *
     * @return JsonResponse
     */
    public function sendResponse($data = null, $message = 'OK', $statusCode = 200, $headers = [])
    {
        $this->setStatusCode($statusCode);
        $this->addHttpHeaders($headers);

        return Response()->json(
            [
                'status_code' => $this->getStatusCode(),
                'status' => $this->getStatusText(),
                'message' => $message,
                'result' => $data
            ],
            $statusCode
        )
            ->withHeaders($this->getHttpHeaders());
    }

    /**
     * @param array $httpHeaders
     */
    public function addHttpHeaders(array $httpHeaders)
    {
        $this->httpHeaders = array_merge($this->httpHeaders, $httpHeaders);
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @param string $text
     *
     * @throws InvalidArgumentException
     */
    public function setStatusCode($statusCode, $text = null)
    {
        $this->statusCode = (int)$statusCode;
        if ($this->isInvalid()) {
            throw new InvalidArgumentException(sprintf('The HTTP status code "%s" is not valid.', $statusCode));
        }

        $this->statusText = false === $text ? '' : (null === $text ? self::$statusTexts[$this->statusCode] : $text);
    }

    /**
     * @return string
     */
    public function getStatusText()
    {
        return $this->statusText;
    }

    /**
     * @return array
     */
    public function getHttpHeaders()
    {
        $default_headers = $this->getDefaultHttpHeaders();
        return array_merge($default_headers, $this->httpHeaders);
    }

    /**
     * @return array
     */
    public function getDefaultHttpHeaders()
    {
        return [
            'Content-Type' => 'application/json'
        ];
    }

    /**
     * @param null $data
     * @param string $message
     * @param int $statusCode
     * @param array $headers
     *
     * @param null $statusText
     *
     * @param null $debug
     *
     * @return JsonResponse
     */
    public function sendErrorResponse(
        $data = null,
        $message = 'ERROR',
        $statusCode = 400,
        $headers = [],
        $statusText = null,
        $debug = null
    ) {
        $this->setStatusCode($statusCode, $statusText);
        $this->addHttpHeaders($headers);

        $errorObject = [
            'status_code' => $this->getStatusCode(),
            'status' => $this->getStatusText(),
            'message' => $message,
            'result' => $data
        ];

        if ($debug) {
            $errorObject['debug'] = $debug;
        }

        return Response()->json($errorObject, $statusCode)
            ->withHeaders($this->getHttpHeaders());
    }


    /**
     * @param $exception
     * @param int $statusCode
     * @param array $headers
     * @param string $message
     * @param null $data
     * @return JsonResponse
     */
    public function sendException($exception, $statusCode = 400, $headers = [], $message = 'Error', $data = null)
    {
        if ($exception) {
            $statusCode = $exception->getCode();
            $message = $exception->getMessage();
        }

        $this->setStatusCode($statusCode);
        $this->addHttpHeaders($headers);

        return Response()->json(
            [
                'status_code' => $this->getStatusCode(),
                'status' => $this->getStatusText(),
                'message' => $message,
                'result' => $data
            ],
            $statusCode
        )
            ->withHeaders($this->getHttpHeaders());
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setHttpHeader($name, $value)
    {
        $this->httpHeaders[$name] = $value;
    }

    /**
     * @param string $format
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function getResponseBody($format = 'json')
    {
        switch ($format) {
            case 'json':
                return $this->parameters ? json_encode($this->parameters) : '';
        }

        throw new InvalidArgumentException(sprintf('The format %s is not supported', $format));
    }


    /**
     * @return bool
     */
    public function isInvalid()
    {
        return $this->statusCode < 100 || $this->statusCode >= 600;
    }


    /**
     * @param null $data
     * @param int $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    public function sendAPIErrorResponse($data = null, $statusCode = 422, $headers = [])
    {
        $this->addHttpHeaders($headers);

        return Response()->json(
            [
                'status' => $statusCode,
                'content' => $data
            ],
            $statusCode
        )
            ->withHeaders($this->getHttpHeaders());
    }

}
