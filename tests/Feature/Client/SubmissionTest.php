<?php

use Alpifra\DaxiumPHP\Client\Structure;
use Alpifra\DaxiumPHP\Client\Submission;
use Alpifra\DaxiumPHP\Representation\SubmissionRepresentation;

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
    $submissions = $daxiumSubmission->listByStructure($id);

    expect($submissions)
        ->toBeArray()
        ->not()
        ->toBeNull();

    foreach ($submissions as $submission) {
        expect($submission)
            ->toBeInstanceOf(SubmissionRepresentation::class);

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
    $submissions = $daxiumSubmission->listByStructure($id);
    $uuid = $submissions[0]->id;

    $submission = $daxiumSubmission->find($uuid);

    expect($submission)
        ->toBeInstanceOf(SubmissionRepresentation::class)
        ->not()
        ->toBeNull();

    expect($submission->id)
        ->toEqual($uuid);

})->group('request', 'submission');
