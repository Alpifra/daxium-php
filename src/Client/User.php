<?php

namespace Alpifra\DaxiumPHP\Client;

use Alpifra\DaxiumPHP\BaseClient;
use Alpifra\DaxiumPHP\Representation\UserRepresentation;

/**
 * User service manager from Daxium API
 * 
 * @see https://doc-dev.daxium-air.com/#utilisateurs
 */
class User extends BaseClient
{

    /**
     * List all users
     *
     * @return UserRepresentation[]
     */
    public function list(): array
    {
        $data = $this->initRequest()->get('/users');
        $users = [];

        foreach ($data->users as $user) {
            $users[] = new UserRepresentation($user);
        }

        return $users;
    }

    /**
     * Find a user by id
     *
     * @param  int $id
     * @return UserRepresentation
     */
    public function find(int $id): UserRepresentation
    {
        $data = $this->initRequest()->get("/users/{$id}");

        return new UserRepresentation($data);
    }

    /**
     * Find a user by id
     *
     * @param  string $username
     * @return UserRepresentation[]
     */
    public function findByUsername(string $username): array
    {
        $data = $this->initRequest()->get("/{$this->appShort}/users", ['username' => $username]);
        $users = [];

        foreach ($data->users as $user) {
            $users[] = new UserRepresentation($user);
        }

        return $users;
    }

}
