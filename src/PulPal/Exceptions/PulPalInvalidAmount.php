<?php

namespace Shahmal1yev\Payment\PulPal\Exceptions;

use Exception;

class PulPalInvalidAmount extends Exception
{
    const THROW_MUST_BE_ZERO = "If \"productType\" is 4, \"amount\" must be 0";
    const THROW_MUST_BE_NON_NEGATIVE = "\"amount\" must not be less than zero";

    public function __construct(string $message)
    {
        $message = "INVALID AMOUNT: $message";
        parent::__construct(
            $message,
            0,
            null
        );
    }
}