<?php

use Alpifra\DaxiumPHP\Client\Report;

it('can find report by submission', function () {

    $daxiumReport = new Report(
        DAXIUM_USER_ID,
        DAXIUM_USER_SECRET,
        DAXIUM_USERNAME,
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $uuid = SUBMISSION_UUID;
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

    $uuid = SUBMISSION_UUID;
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
