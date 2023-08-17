<?php

use Alpifra\DaxiumPHP\Client\User;
use Alpifra\DaxiumPHP\Representation\UserRepresentation;

it('can get users collection', function () {

    $daxiumUser = new User(
        getenv('DAXIUM_USER_ID'), 
        getenv('DAXIUM_USER_SECRET'), 
        getenv('DAXIUM_USERNAME'), 
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $users = $daxiumUser->list();

    expect($users)
        ->toBeArray();

    expect($users[0])
        ->toBeInstanceOf(UserRepresentation::class);

})->group('request', 'user');

it('can get users by username', function () {

    $daxiumUser = new User(
        getenv('DAXIUM_USER_ID'), 
        getenv('DAXIUM_USER_SECRET'), 
        getenv('DAXIUM_USERNAME'), 
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $users = $daxiumUser->findByUsername(getenv('DAXIUM_USERNAME'));

    expect($users)
        ->toBeArray();

    expect($users[0])
        ->toBeInstanceOf(UserRepresentation::class);

    foreach ($users as $user) {
        expect($user->email)
            ->toEqual(getenv('DAXIUM_USERNAME'));
    }

})->group('request', 'user');
