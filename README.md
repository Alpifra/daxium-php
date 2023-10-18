# PHP Daxium API

A basic and stand-alone PHP client interracting with the Daxium Air API V1.3 services.
For more information about the API please see the [documentation](https://doc-dev.daxium-air.com/).

## Installation

The recommended way to install Daxium API PHP client is through composer:

```bash
composer require alpifra/daxium-php
```

But you can also install through the Github repository:

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

### Instanciate client

```php
<?php

$client = new Alpifra\DaxiumPHP\Daxium(
    '***CLIENT_ID***',
    '***CLIENT_SECRET***',
    '***USERNAME***',
    '***PASSWORD***',
);
```

### All various client

- Listing : interract with [listes](https://doc-dev.daxium-air.com/#listes)
- Report : interract with [publipostages](https://doc-dev.daxium-air.com/#publipostages)
- Structure : interract with [formulaires](https://doc-dev.daxium-air.com/#formulaires)
- Submission : interract with [fiches](https://doc-dev.daxium-air.com/#fiches)
- Task : interract with [taches](https://doc-dev.daxium-air.com/#taches)
- User : interract with [utilisateurs](https://doc-dev.daxium-air.com/#utilisateurs)

```php
<?php

$listClient       = new Alpifra\DaxiumPHP\Client\Listing('***CLIENT_ID***', '***CLIENT_SECRET***', '***USERNAME***', '***PASSWORD***');
$reportClient     = new Alpifra\DaxiumPHP\Client\Report('***CLIENT_ID***', '***CLIENT_SECRET***', '***USERNAME***', '***PASSWORD***');
$structureClient  = new Alpifra\DaxiumPHP\Client\Structure('***CLIENT_ID***', '***CLIENT_SECRET***', '***USERNAME***', '***PASSWORD***');
$submissionClient = new Alpifra\DaxiumPHP\Client\Submission('***CLIENT_ID***', '***CLIENT_SECRET***', '***USERNAME***', '***PASSWORD***');
$taskClient       = new Alpifra\DaxiumPHP\Client\Task('***CLIENT_ID***', '***CLIENT_SECRET***', '***USERNAME***', '***PASSWORD***');
$userClient       = new Alpifra\DaxiumPHP\Client\User('***CLIENT_ID***', '***CLIENT_SECRET***', '***USERNAME***', '***PASSWORD***');
```

## Contribution

This package only implement the Daxium API services that I need, but you're welcome to contribute to this repository with your own implementation by sending me a PR. Happy coding !