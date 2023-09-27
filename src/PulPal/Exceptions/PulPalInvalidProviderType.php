<?php

namespace Shahmal1yev\Payment\PulPal\Exceptions;

use Exception;

class PulPalInvalidProviderType extends Exception
{
    const THROW_NOT_AVAILABLE = "\"providerType\" is not available";

    public function __construct(string $message)
    {
        $message = "INVALID PROVIDER TYPE: $message";
        parent::__construct(
            $message,
            0,
            null
        );
    }
}