# PHP Daxium API

A basic and stand-alone PHP client interracting with the Daxium Air API V1.3 services.
For more information about the API please see the [documentation](https://doc-dev.daxium-air.com/).

## Installation

The recommended way to install Daxium API PHP client is through this Github repository:

```json
    {
        "requires": {
            "alpifra/daxium-php": "dev-master",
            ...
        }
        "repositories": [
            {
                "type": "vcs",
                "url": "https://github.com/Alpifra/daxium-php.git"
            }
        ],
    }
```

## Usage

#### Instanciate client

```php
<?php

$client = new Alpifra\DaxiumPHP\Daxium(
    '***CLIENT_ID***',
    '***CLIENT_SECRET***',
    '***USERNAME***',
    '***PASSWORD***',
);
```

## Contribution

This package only implement the Daxium API services that I need, but you're welcome to contribute to this repository with your own implementation by sending me a PR. Happy coding !