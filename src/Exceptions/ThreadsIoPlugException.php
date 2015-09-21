<?php

namespace Wabel\ThreadsIo\Exceptions;

/**
 * Exception raised when an error occurs whithin the package
 *
 * Class ThreadsIoPlugException
 * @package Wabel\ThreadsIo\Exceptions
 */
class ThreadsIoPlugException extends \Exception
{
    /**
     * Exception constructor.
     * @param string $message
     */
    public function __construct($message) {
        parent::__construct($message);
    }
}