<?php

namespace Shahmal1yev\Payment\Contracts;

interface FactoryContract
{
    public static function create(): ServiceContract;
    public static function boot(ProviderContract $provider): void;
}