<?php

namespace Shahmal1yev\Payment\PulPal\Exceptions;

use Exception;

class PulPalInvalidProductType extends Exception
{
    const THROW_NOT_AVAILABLE = "\"productType\" is not available";

    public function __construct(string $message)
    {
        $message = "INVALID PRODUCT TYPE: $message";
        parent::__construct(
            $message,
            0,
            null
        );
    }
}