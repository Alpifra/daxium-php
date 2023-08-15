<?php

namespace Alpifra\DaxiumPHP\Client;

use Alpifra\DaxiumPHP\BaseClient;


/**
 * User service manager from Daxium API
 * 
 * @see https://doc-dev.daxium-air.com/#utilisateurs
 */
class Users extends BaseClient
{

    /**
     * List all users
     *
     * @return \stdClass
     */
    public function list(): \stdClass
    {
        return $this->initRequest()->get('/users');
    }

    /**
     * Find a user by id
     *
     * @param  int $id
     * @return \stdClass
     */
    public function find(int $id): \stdClass
    {
        return $this->initRequest()->get("/users/{$id}");
    }

    /**
     * Find a user by id
     *
     * @param  string $username
     * @return \stdClass
     */
    public function findByUsername(string $username): \stdClass
    {
        $appShort = DAXIUM_APP_SHORT;

        return $this->initRequest()->get("/{$appShort}/users", ['username' => $username]);
    }

}
