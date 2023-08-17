<?php

use Alpifra\DaxiumPHP\Client\Task;
use Alpifra\DaxiumPHP\Client\User;
use Alpifra\DaxiumPHP\Representation\TaskRepresentation;
use Alpifra\DaxiumPHP\Representation\SubmissionRepresentation;

it('can get tasks collection', function () {

    $daxiumTask = new Task(
        getenv('DAXIUM_USER_ID'), 
        getenv('DAXIUM_USER_SECRET'), 
        getenv('DAXIUM_USERNAME'), 
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $tasks = $daxiumTask->list();

    expect($tasks)
        ->toBeArray();

})->group('request', 'task');

it('can create a new task for a user', function() {

    $daxiumUser = new User(
        getenv('DAXIUM_USER_ID'),
        getenv('DAXIUM_USER_SECRET'),
        getenv('DAXIUM_USERNAME'),
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $users = $daxiumUser->findByUsername(getenv('DAXIUM_USERNAME'));
    $user = $users[0]->id;

    expect($user)
        ->toBeInt();

    $startAt = (new \DateTime('tomorrow'))->setTime(9, 0);
    $endAt = clone $startAt;
    $endAt->modify('1 hour');

    $daxiumTask = new Task(
        getenv('DAXIUM_USER_ID'),
        getenv('DAXIUM_USER_SECRET'),
        getenv('DAXIUM_USERNAME'),
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $submissionUuid = getenv('SUBMISSION_UUID');
    $task = $daxiumTask->create($user, $startAt, $endAt, [$submissionUuid]);

    expect($task)
        ->toBeInstanceOf(TaskRepresentation::class);

    expect($task->user_id)
        ->toEqual($user);

    expect($task->submission)
        ->not()
        ->toBeNull()
        ->toBeInstanceof(SubmissionRepresentation::class);

    expect($task->submission->id)
        ->toEqual($submissionUuid);

})->group('request', 'task');

it('can delete an existing task', function() {

    $daxiumTask = new Task(
        getenv('DAXIUM_USER_ID'),
        getenv('DAXIUM_USER_SECRET'),
        getenv('DAXIUM_USERNAME'),
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $tasks = $daxiumTask->list();
    $targetTask = $tasks[0];

    expect($targetTask->id)
        ->not()
        ->toBeNull();

    $daxiumTask = new Task(
        getenv('DAXIUM_USER_ID'),
        getenv('DAXIUM_USER_SECRET'),
        getenv('DAXIUM_USERNAME'),
        getenv('DAXIUM_PASSWORD'),
        getenv('DAXIUM_APP_SHORT')
    );

    $response = $daxiumTask->remove($targetTask->id);

    expect($response)
        ->toBeNull();

})->group('request', 'task');
