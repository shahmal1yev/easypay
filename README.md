# PHP Payment Services

A PHP package that makes it easy to integrate different online payment systems into your projects.

![Banner](./banner.webp)

## Getting Started

To start using the project, follow the steps below.

### Requirements

Specify the software and libraries required to use your project. For example:

- PHP 8.0 or newer
- Composer 2 (package manager)
- [vlucas/dotenv package](https://github.com/vlucas/phpdotenv)

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

Provide examples and usage scenarios for how to use the project. Including sample code can help users get started quickly.

```php
require_once 'vendor/autoload.php';

use Shahmal1yev\Payment\Factories\AzericardFactory;

$azericard = AzericardFactory::create();

$azericard->complete(12);
```

### Contributing

The project is generally open to pull requests. Once reviewed and deemed suitable, I will approve them.