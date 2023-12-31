# PHP Payment Integration Package

A PHP package that makes it easy to integrate different online payment systems into your projects.

![Banner](./banner.png)

## Getting Started

To start using the package, follow the steps below.

### Requirements

Specify the software and libraries required to use your project. For example:

- PHP 8.0 or newer
- [Composer 2](https://getcomposer.org/download/)
- [vlucas/dotenv package](https://github.com/vlucas/phpdotenv)
- [PHPUnit](https://phpunit.de/getting-started/phpunit-10.html)
- [PHP Curl Library](https://www.php.net/manual/en/curl.setup.php)

### Installation

To install the project, follow these steps:

1. Add the following line to the `composer.json` file in the project's root directory:

```json
"require": {
    "shahmal1yev/payment-services": "^1.0"
}
```

2. Run the following command in the command line to install dependencies:

```bash
$ composer install
```
3. You can now start using the project.

### Usage

```php
use Shahmal1yev\Payment\Factories\Azericard\AzericardFactory;

$azericard = AzericardFactory::create();

$azericard->process(
    000001, /* order */ 
    "Description of the sale", 
    2.5 /* amount */
);
```

```php
use Shahmal1yev\Payment\Factories\Azericard\AzericardFactory;
use Shahmal1yev\Payment\Contracts\ProviderContract;

class AzericardCustomFactory extends AzericardFactory
{
    public static function boot(ProviderContract $provider): void
    {
        $provider->setCountry("US")
            ->setLang("EN")
            ->setCurrency("USD");
    }
}

$azericard = AzericardCustomFactory::create();

$azericard->process(
    000001, /* order */ 
    "Description of the sale", 
    2.5 /* amount */
);
```

```env
# .env file

AZERICARD_PS_URL="NULL"
AZERICARD_PS_MERCHANT_NAME="NULL"
AZERICARD_PS_MERCHANT_URL="NULL"
AZERICARD_PS_TERMINAL="NULL"
AZERICARD_PS_EMAIL="NULL"
AZERICARD_PS_TRTYPE="1"
AZERICARD_PS_CURRENCY="NULL"
AZERICARD_PS_COUNTRY="AZ"
AZERICARD_PS_GMT="+4"
AZERICARD_PS_KEY_FOR_SIGN="NULL"
AZERICARD_PS_BACKREF="NULL"
AZERICARD_PS_LANG="NULL"
```

```php
$azericard->callback(function($order, $rrn, $intRef) {
    # callback for result

    # $order   => order
    # $rrn     => rrn
    # $intRef  => int ref
});
```

### Contributing

The project is generally open to pull requests. Once reviewed and deemed suitable, I will approve them.

### License

The PHP Payment Integration Package is licensed under the [MIT License](LICENSE). You are free to use, modify, and distribute this PHP package in accordance with the terms specified in the license.