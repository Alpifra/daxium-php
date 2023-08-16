<?php

use Alpifra\DaxiumPHP\Client\User;
use Alpifra\DaxiumPHP\Representation\UserRepresentation;

it('can get users collection', function () {

    $daxiumUser = new User(
        DAXIUM_USER_ID, 
        DAXIUM_USER_SECRET, 
        DAXIUM_USERNAME, 
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $users = $daxiumUser->list();

    expect($users)
        ->toBeArray();

    expect($users[0])
        ->toBeInstanceOf(UserRepresentation::class);

})->group('request', 'user');

it('can get users by username', function () {

    $daxiumUser = new User(
        DAXIUM_USER_ID, 
        DAXIUM_USER_SECRET, 
        DAXIUM_USERNAME, 
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $users = $daxiumUser->findByUsername(DAXIUM_USERNAME);

    expect($users)
        ->toBeArray();

    expect($users[0])
        ->toBeInstanceOf(UserRepresentation::class);

    foreach ($users as $user) {
        expect($user->email)
            ->toEqual(DAXIUM_USERNAME);
    }

})->group('request', 'user');
