<?php

namespace Shahmal1yev\Payment\Factories\Azericard;

use Shahmal1yev\Payment\Contracts\FactoryContract;
use Shahmal1yev\Payment\Contracts\ProviderContract;
use Shahmal1yev\Payment\Contracts\ServiceContract;
use Shahmal1yev\Payment\Services\Azericard\AzericardService;

class AzericardFactory implements FactoryContract
{
    protected static ServiceContract $service; 

    public static function create(): ServiceContract
    {
        self::$service = new AzericardService();

        (new static())->boot(self::$service->provider());

        return self::$service;
    }

    public static function boot(ProviderContract $provider): void
    {
        # $provider->setUrl("...");
    }
}