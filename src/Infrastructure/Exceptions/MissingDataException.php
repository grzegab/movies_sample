<?php

declare(strict_types=1);

namespace App\Infrastructure\Exceptions;

class MissingDataException extends \RuntimeException
{
    public function __construct(string $message = 'Could not find data', int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
