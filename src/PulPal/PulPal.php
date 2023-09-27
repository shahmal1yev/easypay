<?php

namespace Shahmal1yev\Payment\PulPal;

use Shahmal1yev\Payment\PulPal\Exceptions\PulPalInvalidDebt;
use Shahmal1yev\Payment\PulPal\Exceptions\PulPalInvalidPrice;
use Shahmal1yev\Payment\PulPal\Exceptions\PulPalInvalidAmount;
use Shahmal1yev\Payment\PulPal\Exceptions\PulPalInvalidProductType;
use Shahmal1yev\Payment\PulPal\Exceptions\PulPalInvalidProviderType;

class PulPal
{
    private string $price;
    private int $productType;
    private string $externalId;
    private int $debt;
    private int $amount;
    private int $providerType;
    private string $paymentAttempt;

    private array $availableProductTypes;
    private array $availableProviderTypes;

    public function __construct()
    {
        $this->availableProductTypes = json_decode(getenv("PULPAL_PRODUCT_TYPES", true));
        $this->availableProviderTypes = json_decode(getenv("PULPAL_PROVIDER_TYPES", true));
    }

    public function setPrice(int $price): PulPal
    {
        if (strlen($price) > 32)
        {
            throw new PulPalInvalidPrice(PulPalInvalidPrice::THROW_MAXLENGTH);
        }

        $this->price = $price;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setProductType(string $productType): PulPal
    {
        $availableProductTypes = $this->getAvailableProductTypes();

        if (!array_key_exists($productType, $availableProductTypes))
        {
            throw new PulPalInvalidProductType(PulPalInvalidProductType::THROW_NOT_AVAILABLE);
        }

        $this->productType = $availableProductTypes[$productType];

        return $this;
    }

    public function getProductType(): string
    {
        return $this->productType;
    }

    public function setExternalId(string $externalId): PulPal
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setDebt(int $debt): PulPal
    {
        if ($this->getProductType() === 3)
        {
            if ($debt != 0)
            {
                throw new PulPalInvalidDebt(PulPalInvalidDebt::THROW_MUST_BE_ZERO);
            }
        }

        if ($debt < 0)
        {
            throw new PulPalInvalidDebt(PulPalInvalidDebt::THROW_MUST_BE_NON_NEGATIVE);
        }

        $this->debt = $debt;

        return $this;
    }

    public function getDebt(): int
    {
        return $this->debt;
    }

    public function setAmount(int $amount): PulPal
    {
        $productType = $this->getProductType();

        if ($productyType === 4)
        {
            if ($amount != 0)
            {
                throw new PulPalInvalidAmount(PulPalInvalidAmount::THROW_MUST_BE_ZERO);
            }
        }

        if ($amount < 0)
        {
            throw new PulPalInvalidAmount(PulPalInvalidAmount::THROW_MUST_BE_NON_NEGATIVE);
        }

        $this->amount = $amount;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setProviderType(string $providerType): PulPal
    {
        $availableProviderTypes = $this->getAvailableProviderTypes();

        if (!array_key_exists($providerType, $availableProviderTypes))
        {
            throw new PulPalInvalidProviderType(PulPalInvalidProviderType::THROW_NOT_AVAILABLE);
        }

        $this->providerType = $availableProviderTypes[$providerType];

        return $this;
    }

    public function getProviderType(): int
    {
        return $this->providerType;
    }

    public function setPaymentAttempt(string $paymentAttempt): PulPal
    {
        $this->paymentAttempt = $paymentAttempt;

        return $this;
    }

    public function getPaymentAttempt(): string
    {
        return $this->paymentAttempt;
    }

    public function getAvailableProviderTypes(): array
    {
        return $this->availableProviderTypes;
    }

    public function getAvailableProductTypes(): array
    {
        return $this->availableProductTypes;
    }
}