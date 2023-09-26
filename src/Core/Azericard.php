<?php

namespace Shahmal1yev\Payment\Core;

use Shahmal1yev\Payment\Contracts\Payment\ProviderContract;

class Azericard implements ProviderContract
{
    private string $url;
    private string $merchName;
    private string $merchUrl;
    private string $terminal;
    private string $email;
    private string $trtype;
    private string $currency;
    private string $country;
    private string $merchGmt;
    private string $keyForSign;
    private string $backref;
    private string $lang;

    public function __construct()
    {
        $this->setUrl()
            ->setMerchName()
            ->setMerchUrl()
            ->setTerminal()
            ->setEmail()
            ->setTrtype()
            ->setCurrency()
            ->setCountry()
            ->setMerchGmt()
            ->setKeyForSign()
            ->setBackref()
            ->setLang();
    }

    /**
     * Get the value of url
     */ 
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @return  self
     */ 
    public function setUrl(string $url = null): Azericard
    {
        $this->url = $url ?? getenv("AZERICARD_PS_URL");

        return $this;
    }

    /**
     * Get the value of merchName
     */ 
    public function getMerchName(): string
    {
        return $this->merchName;
    }

    /**
     * Set the value of merchName
     *
     * @return  self
     */ 
    public function setMerchName(string $merchName = null): Azericard
    {
        $this->merchName = $merchName ?? getenv("AZERICARD_PS_MERCHANT_NAME");

        return $this;
    }

    /**
     * Get the value of merchUrl
     */ 
    public function getMerchUrl(): string
    {
        return $this->merchUrl;
    }

    /**
     * Set the value of merchUrl
     *
     * @return  self
     */ 
    public function setMerchUrl(string $merchUrl = null): Azericard
    {
        $this->merchUrl = $merchUrl ?? getenv("AZERICARD_PS_MERCHANT_URL");

        return $this;
    }

    /**
     * Get the value of terminal
     */ 
    public function getTerminal(): string
    {
        return $this->terminal;
    }

    /**
     * Set the value of terminal
     *
     * @return  self
     */ 
    public function setTerminal(string $terminal = null): Azericard
    {
        $this->terminal = $terminal ?? getenv("AZERICARD_PS_TERMINAL");

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(string $email = null): Azericard
    {
        $this->email = $email ?? getenv("AZERICARD_PS_EMAIL");

        return $this;
    }

    /**
     * Get the value of trtype
     */ 
    public function getTrtype(): string
    {
        return $this->trtype;
    }

    /**
     * Set the value of trtype
     *
     * @return  self
     */ 
    public function setTrtype(string $trtype = null): Azericard
    {
        $this->trtype = $trtype ?? getenv("AZERICARD_PS_TRTYPE");

        return $this;
    }

    /**
     * Get the value of currency
     */ 
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Set the value of currency
     *
     * @return  self
     */ 
    public function setCurrency(string $currency = null): Azericard
    {
        $this->currency = $currency ?? getenv("AZERICARD_PS_CURRENCY");

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry(string $country = null): Azericard
    {
        $this->country = $country ?? getenv("AZERICARD_PS_COUNTRY");

        return $this;
    }

    /**
     * Get the value of gmt
     */ 
    public function getMerchGmt(): string
    {
        return $this->merchGmt;
    }

    /**
     * Set the value of gmt
     *
     * @return  self
     */ 
    public function setMerchGmt(string $merchGmt = null): Azericard
    {
        $this->merchGmt = $merchGmt ?? getenv("AZERICARD_PS_GMT");

        return $this;
    }

    /**
     * Get the value of keyForSign
     */ 
    public function getKeyForSign(): string
    {
        return $this->keyForSign;
    }

    /**
     * Set the value of keyForSign
     *
     * @return  self
     */ 
    public function setKeyForSign(string $keyForSign = null): Azericard
    {
        $this->keyForSign = $keyForSign ?? getenv("AZERICARD_PS_KEY_FOR_SIGN");

        return $this;
    }

    /**
     * Get the value of backref
     */ 
    public function getBackref(): string
    {
        return $this->backref;
    }

    /**
     * Set the value of backref
     *
     * @return  self
     */ 
    public function setBackref(string $backref = null): Azericard
    {
        $this->backref = $backref ?? getenv("AZERICARD_PS_BACKREF");

        return $this;
    }

    /**
     * Get the value of lang
     */ 
    public function getLang(): string 
    {
        return $this->lang;
    }

    /**
     * Set the value of lang
     *
     * @return  self
     */ 
    public function setLang(string $lang = null): Azericard
    {
        $this->lang = $lang ?? getenv("AZERICARD_PS_LANG");

        return $this;
    }

    public function getOperTime(): string
    {
        return gmdate("YmdHis");
    }

    public function getNonce(): string
    {
        return substr(md5(rand()),0,16);
    }

    public function getToSign(
        float $amount,
        string $desc,
        int $order,
        string $timestamp,
        string $nonce
    ): string
    {
        $requirements = [
            $amount,
            $this->getCurrency(),
            $order,
            $desc,
            $this->getMerchName(),
            $this->getMerchUrl(),
            $this->getTerminal(),
            $this->getEmail(),
            "1",
            $this->getCountry(),
            $this->getMerchGmt(),
            $timestamp,
            $nonce,
            $this->getBackref()
        ];

        $toSign = "";

        foreach($requirements as $item)
        {
            $toSign .= strlen($item) . $item;
        }

        return $toSign;
    }

    public function getPSign(string $toSign): string
    {
        return hash_hmac("sha1", $toSign, hex2bin($this->getKeyForSign()));
    }
}