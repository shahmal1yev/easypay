<?php

namespace Shahmal1yev\Payment\PulPal\Exceptions;

use Exception;

class PulPalInvalidPrice extends Exception
{
    const THROW_MAXLENGTH = "\"price\" cannot exceed 32 digits in length";

    public function __construct(string $message)
    {
        $message = "INVALID PRICE: $message";

        parent::__construct(
            $message,
            0,
            null
        );
    }
}