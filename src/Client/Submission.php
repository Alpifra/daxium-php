<?php

namespace Alpifra\DaxiumPHP\Client;

use Alpifra\DaxiumPHP\BaseClient;


/**
 * Submission service manager from Daxium API
 * 
 * @see https://doc-dev.daxium-air.com/#recuperer-les-fiches-d-39-un-formulaire
 */
class Submission extends BaseClient
{

    /**
     * Find all submissions by form id
     *
     * @param  int $id
     * @return \stdClass
     */
    public function listByStructure(int $id): \stdClass
    {
        return $this->initRequest()->get("/{$this->appShort}/submissions", ['structure_id' => $id]);
    }

    /**
     * Find a submission by uuid
     *
     * @param  string $uuid
     * @return \stdClass
     */
    public function find(string $uuid): \stdClass
    {
        return $this->initRequest()->get("/{$this->appShort}/submissions/{$uuid}");
    }

}
