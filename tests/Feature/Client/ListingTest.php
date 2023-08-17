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

it('can add item to a list', function () {

    $daxiumListing = new Listing(
        DAXIUM_USER_ID,
        DAXIUM_USER_SECRET,
        DAXIUM_USERNAME,
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $stdClass1 = new \stdClass;
    $stdClass1->name = 'Testing name ' . uniqid();
    $stdClass1->external_id = 'Testing external id ' . uniqid();
    $stdClass1->color = 'https://testing.com';
    $stdClass1->functionnal_status_color = 'green';
    $stdClass1->created_at = time();

    $stdClass2 = clone $stdClass1;
    $stdClass2->name = 'Testing name ' . uniqid();
    $stdClass2->external_id = 'Testing external id ' . uniqid();

    $item1 = new ListingRepresentation($stdClass1);
    $item2 = new ListingRepresentation($stdClass2);

    $lists = $daxiumListing->add(PARENT_LIST_CLIENT_ID, [$item1, $item2]);

    expect($lists)
        ->toBeArray();

    foreach ($lists as $list) {
        expect($list)
            ->toBeInstanceOf(ListingRepresentation::class);

        expect($list->name)
            ->toContain("Testing name");

        expect($list->external_id)
            ->toContain("Testing external id");
    }

})->group('request', 'list', 'demo');
