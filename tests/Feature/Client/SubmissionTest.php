<?php

use Alpifra\DaxiumPHP\Client\Structure;
use Alpifra\DaxiumPHP\Client\Submission;
use Alpifra\DaxiumPHP\Representation\SubmissionRepresentation;

it('can list submissions collection by structure', function () {

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

    $daxiumSubmission = new Submission(
        getenv('DAXIUM_USER_ID'), 
        getenv('DAXIUM_USER_SECRET'), 
        getenv('DAXIUM_USERNAME'), 
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
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

    $daxiumSubmission = new Submission(
        getenv('DAXIUM_USER_ID'), 
        getenv('DAXIUM_USER_SECRET'), 
        getenv('DAXIUM_USERNAME'), 
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
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

it('can find a submission file by uuid', function () {

    $daxiumSubmission = new Submission(
        getenv('DAXIUM_USER_ID'), 
        getenv('DAXIUM_USER_SECRET'), 
        getenv('DAXIUM_USERNAME'), 
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $submissionUuid = getenv('SUBMISSION_UUID');
    $fileUuid = getenv('SUBMISSION_FILE_UUID');

    $data = $daxiumSubmission->findFile($submissionUuid, $fileUuid);

    expect($data)
        ->not()
        ->toBeNull();

})->group('request', 'submission');

it('can create a new submission', function () {

    $daxiumSubmission = new Submission(
        getenv('DAXIUM_USER_ID'),
        getenv('DAXIUM_USER_SECRET'),
        getenv('DAXIUM_USERNAME'),
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $submission = $daxiumSubmission->create(
        getenv('STRUCTURE_FORMV4_ID'),
        getenv('STRUCTURE_FORMV4_VERSION'),
        ['RefAffaire' => [getenv('LIST_PROJECT_TEST_ID')]],
        true
    );

    expect($submission)
        ->toBeInstanceOf(SubmissionRepresentation::class)
        ->not()
        ->toBeNull();

})->group('request', 'submission');
