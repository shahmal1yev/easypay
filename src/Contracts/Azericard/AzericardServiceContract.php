<?php

namespace Shahmal1yev\Payment\Contracts\Azericard;

use Shahmal1yev\Payment\Providers\Azericard\Azericard;

interface AzericardServiceContract
{
    public function process(int $order, string $desc, float $amount): mixed;
    public function callback(callable $callback): mixed;
    public function provider(): Azericard;
    public function getRequestData(int $order, string $desc, float $amount): array;
}