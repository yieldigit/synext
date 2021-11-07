<?php

namespace Synext\Exceptions;

/**
 * [Description ExceptionInterface] Exception interface who all exception class should implement 
 */
interface ExceptionInterface
{
    public function getMessage(): string;
    public function getCode(): string;
    public function getFile(): string;
    public function getLine(): string;
    public function getTrace(): string;
    public function getTraceAsString(): string;
    public function __toString(): string;
    public function __construct($message = null, $code = 0);
}
