<?php

namespace Shahmal1yev\Payment\Services;

use Shahmal1yev\Payment\Core\Azericard;
use Shahmal1yev\Payment\Contracts\Payment\ServiceContract;
use Shahmal1yev\Payment\Contracts\Payment\ProviderContract;

class AzericardService implements ServiceContract
{
    private ProviderContract $provider;
    
    public function __construct(
    )
    {
        $this->provider = new Azericard;
    }

    public function process(
        int $order,
        string $desc,
        float $amount
    ): mixed
    {
        $url = $this->provider()->getUrl();
        $ch = curl_init($url);
        $data = $this->getRequestData();

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

    public function callback(
        callable $callback
    ): mixed
    {
        $rrn = (isset($_POST['rrn'])) ? $_POST['rrn'] : null;
        $order = (isset($_POST['order'])) ? $_POST['order'] : null;
        $intRef = (isset($_POST['intRef'])) ? $_POST['intRef'] : null;
        $terminal = (isset($_POST['terminal'])) ? $_POST['terminal'] : null;

        if ($rrn && $order && $intRef && $terminal === $this->provider()->getTerminal())
        {
            return $callback($order, $rrn, $intRef);
        }

        return false;
    }

    public function provider()
    {
        return $this->provider;
    }

    public function getRequestData(int $order, string $desc, float $amount): array
    {
        $currency = $this->provider()->getCurrency();
        $merchName = $this->provider()->getMerchName();
        $merchUrl = $this->provider()->getMerchUrl();
        $terminal = $this->provider()->getTerminal();
        $email = $this->provider()->getEmail();
        $trtype = $this->provider()->getTrtype();
        $country = $this->provider()->getCountry();
        $merchGmt = $this->provider()->getMerchGmt();
        $timestamp = $this->provider()->getOperTime();
        $nonce = $this->provider()->getNonce();
        $backref = $this->provider()->getBackref();
        $lang = $this->provider()->getLang();
        $toSign = $this->provider()->getToSign($amount, $desc, $order, $timestamp, $nonce);
        $pSign = $this->provider()->getPSign($toSign);

        $data = [
            'AMOUNT' => $amount,
            'CURRENCY' => $currency,
            'ORDER' => $order,
            'DESC' => $desc,
            'MERCH_NAME' => $merchName,
            'MERCH_URL' => $merchUrl,
            'TERMINAL' => $terminal,
            'EMAIL' => $email,
            'TRTYPE' => $trtype,
            'COUNTRY' => $country,
            'MERCH_GMT' => $merchGmt,
            'TIMESTAMP' => $timestamp,
            'NONCE' => $nonce,
            'BACKREF' => $backref,
            'LANG' => $lang,
            'P_SIGN' => $pSign
        ];

        return $data;
    }
}