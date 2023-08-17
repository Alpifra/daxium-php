<?php

use Alpifra\DaxiumPHP\Client\Report;

it('can find report by submission', function () {

    $daxiumReport = new Report(
        getenv('DAXIUM_USER_ID'),
        getenv('DAXIUM_USER_SECRET'),
        getenv('DAXIUM_USERNAME'),
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $uuid = getenv('SUBMISSION_UUID');
    $response = $daxiumReport->findBySubmission($uuid);

    expect($response)
        ->not()
        ->toBeNull();

    expect($response->reports)
        ->toBeArray();

})->group('request', 'report');

it('can download report', function () {

    $daxiumReport = new Report(
        getenv('DAXIUM_USER_ID'),
        getenv('DAXIUM_USER_SECRET'),
        getenv('DAXIUM_USERNAME'),
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $uuid = getenv('SUBMISSION_UUID');
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
