<?php

namespace Shahmal1yev\Payment\Factories;

use Shahmal1yev\Payment\Contracts\Payment\FactoryContract;
use Shahmal1yev\Payment\Contracts\Payment\ProviderContract;
use Shahmal1yev\Payment\Contracts\Payment\ServiceContract;
use Shahmal1yev\Payment\Services\AzericardService;

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