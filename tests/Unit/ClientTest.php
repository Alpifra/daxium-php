<?php

use Alpifra\DaxiumPHP\Client\User;

test('instanciate Users client class', function () {
    $users = new User('', '', '', '', '');

    expect($users)
        ->toBeInstanceOf(User::class);
});
