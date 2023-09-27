<?php

namespace Shahmal1yev\Payment\PulPal\Exceptions;

use Exception;

class PulPalInvalidDebt extends Exception
{
    const THROW_MUST_BE_ZERO = "If \"productType\" is 4, \"debt\" must be 0";
    const THROW_MUST_BE_NON_NEGATIVE = "\"debt\" must not be less than zero";
    
    public function __construct(string $message)
    {
        $message = "INVALID DEBT: $message";
        parent::__construct(
            $message,
            0,
            null
        );
    }
}