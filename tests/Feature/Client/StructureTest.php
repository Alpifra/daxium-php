<?php

use Alpifra\DaxiumPHP\Client\Structure;

it('can list structures collection', function () {

    $daxiumStructure = new Structure(
        getenv('DAXIUM_USER_ID'), 
        getenv('DAXIUM_USER_SECRET'), 
        getenv('DAXIUM_USERNAME'), 
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $response = $daxiumStructure->list();

    expect($response)
        ->not()
        ->toBeNull();

    expect($response->structures)
        ->toBeArray();

})->group('request', 'structure');

it('can get structure by id', function () {

    $daxiumStructure = new Structure(
        getenv('DAXIUM_USER_ID'),
        getenv('DAXIUM_USER_SECRET'),
        getenv('DAXIUM_USERNAME'),
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $response = $daxiumStructure->list();

    expect($response->structures)
        ->toBeArray();

    $id = $response->structures[0]->id;
    $response = $daxiumStructure->find($id);

    expect($response)
        ->not()
        ->toBeNull();

    expect($response->structure)
        ->toBeArray();

    expect($response->structure[0]->id)
        ->toEqual($id);

})->group('request', 'structure');
