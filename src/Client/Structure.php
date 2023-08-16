<?php

namespace Alpifra\DaxiumPHP\Client;

use Alpifra\DaxiumPHP\BaseClient;


/**
 * Structure service manager from Daxium API
 * 
 * @see https://doc-dev.daxium-air.com/#taches
 */
class Structure extends BaseClient
{

    /**
     * List all structures
     *
     * @return \stdClass
     */
    public function list(): \stdClass
    {
        return $this->initRequest()->get("/{$this->appShort}/structures");
    }

    /**
     * Find a structure by id
     *
     * @param  int $id
     * @return \stdClass
     */
    public function find(int $id): \stdClass
    {
        return $this->initRequest()->get("/{$this->appShort}/structures/{$id}");
    }

}
