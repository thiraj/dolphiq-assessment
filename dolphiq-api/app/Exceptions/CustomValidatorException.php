<?php

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * Class DolphiqException
 * @package App\Exceptions
 */
class CustomValidatorException extends Exception
{
    /**
     * @var array
     */
    protected $errors;


    /**
     * CustomValidatorException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     * @param array $errors
     */
    public function __construct($errors = [], string $message = "", int $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

}
