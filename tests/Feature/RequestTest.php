<?php

use Alpifra\DaxiumPHP\BaseClient;

it('can init request', function() {

    $daxium = new BaseClient(
        getenv('DAXIUM_USER_ID'), 
        getenv('DAXIUM_USER_SECRET'), 
        getenv('DAXIUM_USERNAME'), 
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $response = $daxium->initRequest();

    expect($response->token)
        ->not()
        ->toBeNull();

})->group('request');