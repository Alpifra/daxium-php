<?php

use Alpifra\DaxiumPHP\Client\Report;
use Alpifra\DaxiumPHP\Representation\ReportRepresentation;

it('can find report by submission', function () {

    $daxiumReport = new Report(
        getenv('DAXIUM_USER_ID'),
        getenv('DAXIUM_USER_SECRET'),
        getenv('DAXIUM_USERNAME'),
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $uuid = getenv('SUBMISSION_UUID');
    $reports = $daxiumReport->findBySubmission($uuid);

    expect($reports)
        ->toBeArray();

    foreach ($reports as $report) {
        expect($report)
            ->toBeInstanceOf(ReportRepresentation::class);
    }

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
    $reports = $daxiumReport->findBySubmission($uuid);

    expect($reports)
        ->toBeArray();

    $targetReport = $reports[0];
    $fileId = $targetReport->id;
    $fileUuid = $targetReport->file_uuid;

    expect($targetReport->file_uuid)
        ->not()
        ->toBeNull();

    $response = $daxiumReport->download($fileId, $fileUuid);

    expect($response)
        ->toBeString();

})->group('request', 'report');
