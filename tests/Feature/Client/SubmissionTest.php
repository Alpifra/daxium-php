<?php

use Alpifra\DaxiumPHP\Client\Structure;
use Alpifra\DaxiumPHP\Client\Submission;

it('can list submissions collection by structure', function () {

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

    foreach ($response->submissions as $submission) {
        expect($submission->structure_id)
            ->toEqual($id);
    }

})->group('request', 'submission');

it('can find a submission by uuid', function () {

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

    $uuid = $response->submissions[0]->id;

    $response = $daxiumSubmission->find($uuid);

    expect($response)
        ->not()
        ->toBeNull();

    expect($response->id)
        ->toEqual($uuid);

})->group('request', 'submission');
