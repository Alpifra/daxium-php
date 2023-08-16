<?php

use Alpifra\DaxiumPHP\Client\Task;
use Alpifra\DaxiumPHP\Client\User;

it('can get tasks collection', function () {

    $daxiumTask = new Task(
        DAXIUM_USER_ID, 
        DAXIUM_USER_SECRET, 
        DAXIUM_USERNAME, 
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $response = $daxiumTask->list();

    expect($response)
        ->not()
        ->toBeNull();

    expect($response->tasks)
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

    $response = $daxiumTask->create($user, $startAt, $endAt);

    expect($response->id)
        ->not()
        ->toBeNull();

})->group('request', 'task');

it('can delete an existing task', function() {

    $daxiumTask = new Task(
        DAXIUM_USER_ID,
        DAXIUM_USER_SECRET,
        DAXIUM_USERNAME,
        DAXIUM_PASSWORD,
        DAXIUM_APP_SHORT
    );

    $response = $daxiumTask->list();
    $targetTask = $response->tasks[0];

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
