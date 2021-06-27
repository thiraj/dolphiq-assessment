<?php

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * Class DolphiqException
 * @package App\Exceptions
 */
class DolphiqException extends Exception
{
    /**
     * DolphiqException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
