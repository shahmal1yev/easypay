<?php

require_once "vendor/autoload.php";

use Shahmal1yev\Payment\Factories\Azericard\AzericardFactory;

$azericard = AzericardFactory::create();

$azericard->process(000001, "Desc", 1.5);

$azericard->callback(function($order, $rrn, $intRef) {

});