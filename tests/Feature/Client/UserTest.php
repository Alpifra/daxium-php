<?php

use Alpifra\DaxiumPHP\Client\User;

it('can get users collection', function () {

    $daxiumUser = new User(
        DAXIUM_USER_ID, 
        DAXIUM_USER_SECRET, 
        DAXIUM_USERNAME, 
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $response = $daxiumUser->list();

    expect($response)
        ->not()
        ->toBeNull();

    expect($response->users)
        ->toBeArray();

})->group('request', 'user');

it('can get users by username', function () {

    $daxiumUser = new User(
        DAXIUM_USER_ID, 
        DAXIUM_USER_SECRET, 
        DAXIUM_USERNAME, 
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $response = $daxiumUser->findByUsername(DAXIUM_USERNAME);

    expect($response)
        ->not()
        ->toBeNull();

    expect($response->users)
        ->toBeArray();

    $target = $response->users[0];

    expect($target->email)
        ->toEqual(DAXIUM_USERNAME);

})->group('request', 'user');
