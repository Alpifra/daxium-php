<?php

use Alpifra\DaxiumPHP\Client\Task;
use Alpifra\DaxiumPHP\Client\User;
use Alpifra\DaxiumPHP\Representation\TaskRepresentation;
use Alpifra\DaxiumPHP\Representation\SubmissionRepresentation;

it('can get tasks collection', function () {

    $daxiumTask = new Task(
        DAXIUM_USER_ID, 
        DAXIUM_USER_SECRET, 
        DAXIUM_USERNAME, 
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $tasks = $daxiumTask->list();

    expect($tasks)
        ->toBeArray();

})->group('request', 'task');

it('can create a new task for a user', function() {

    $daxiumUser = new User(
        DAXIUM_USER_ID,
        DAXIUM_USER_SECRET,
        DAXIUM_USERNAME,
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $users = $daxiumUser->findByUsername(DAXIUM_USERNAME);
    $user = $users[0]->id;

    expect($user)
        ->toBeInt();

    $startAt = (new \DateTime('tomorrow'))->setTime(9, 0);
    $endAt = clone $startAt;
    $endAt->modify('1 hour');

    $daxiumTask = new Task(
        DAXIUM_USER_ID,
        DAXIUM_USER_SECRET,
        DAXIUM_USERNAME,
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $task = $daxiumTask->create($user, $startAt, $endAt, [SUBMISSION_UUID]);

    expect($task)
        ->toBeInstanceOf(TaskRepresentation::class);

    expect($task->user_id)
        ->toEqual($user);

    expect($task->submission)
        ->not()
        ->toBeNull()
        ->toBeInstanceof(SubmissionRepresentation::class);

    expect($task->submission->id)
        ->toEqual(SUBMISSION_UUID);

})->group('request', 'task');

it('can delete an existing task', function() {

    $daxiumTask = new Task(
        DAXIUM_USER_ID,
        DAXIUM_USER_SECRET,
        DAXIUM_USERNAME,
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $tasks = $daxiumTask->list();
    $targetTask = $tasks[0];

    expect($targetTask->id)
        ->not()
        ->toBeNull();

    $daxiumTask = new Task(
        DAXIUM_USER_ID,
        DAXIUM_USER_SECRET,
        DAXIUM_USERNAME,
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $response = $daxiumTask->remove($targetTask->id);

    expect($response)
        ->toBeNull();

})->group('request', 'task');
