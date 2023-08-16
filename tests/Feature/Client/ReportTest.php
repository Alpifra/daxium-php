<?php

use Alpifra\DaxiumPHP\Client\Report;
use Alpifra\DaxiumPHP\Client\Structure;
use Alpifra\DaxiumPHP\Client\Submission;

it('can find report by submission', function () {

    $daxiumStructure = new Structure(
        DAXIUM_USER_ID,
        DAXIUM_USER_SECRET,
        DAXIUM_USERNAME,
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $response = $daxiumStructure->list();

    expect($response)
        ->not()
        ->toBeNull();

    expect($response->structures)
        ->toBeArray();

    $daxiumSubmission = new Submission(
        DAXIUM_USER_ID, 
        DAXIUM_USER_SECRET, 
        DAXIUM_USERNAME, 
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $id = $response->structures[0]->id;
    $response = $daxiumSubmission->listByStructure($id);

    expect($response)
        ->not()
        ->toBeNull();

    expect($response->submissions)
        ->toBeArray();

    $daxiumReport = new Report(
        DAXIUM_USER_ID,
        DAXIUM_USER_SECRET,
        DAXIUM_USERNAME,
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $uuid = $response->submissions[0]->id;
    $response = $daxiumReport->findBySubmission($uuid);

    expect($response)
        ->not()
        ->toBeNull();

    expect($response->reports)
        ->toBeArray();

})->group('request', 'report');

it('can download report', function () {

    $daxiumReport = new Report(
        DAXIUM_USER_ID,
        DAXIUM_USER_SECRET,
        DAXIUM_USERNAME,
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $uuid = '91da6291-7653-4053-b631-def8b12ff3f9';
    $response = $daxiumReport->findBySubmission($uuid);

    expect($response)
        ->not()
        ->toBeNull();

    expect($response->reports)
        ->toBeArray();

    $targetReport = $response->reports[0];
    $fileId = $targetReport->id;
    $fileUuid = $targetReport->original_document->file_uuid;
    $response = $daxiumReport->download($fileId, $fileUuid);

    expect($response)
        ->toBeString();

})->group('request', 'report');
