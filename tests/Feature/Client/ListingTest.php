<?php

use Alpifra\DaxiumPHP\Client\Listing;
use Alpifra\DaxiumPHP\Representation\ListingRepresentation;

it('can list lists collection', function () {

    $daxiumListing = new Listing(
        DAXIUM_USER_ID, 
        DAXIUM_USER_SECRET, 
        DAXIUM_USERNAME, 
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $lists = $daxiumListing->list();

    expect($lists)
        ->toBeArray();

    foreach ($lists as $list) {
        expect($list)
            ->toBeInstanceOf(ListingRepresentation::class);
    }

})->group('request', 'list');

it('can get list by id', function () {

    $daxiumListing = new Listing(
        DAXIUM_USER_ID,
        DAXIUM_USER_SECRET,
        DAXIUM_USERNAME,
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $lists = $daxiumListing->find(LIST_CLIENT_ID);

    expect($lists)
        ->toBeArray();

    foreach ($lists as $list) {
        expect($list)
            ->toBeInstanceOf(ListingRepresentation::class);
    }

})->group('request', 'list');