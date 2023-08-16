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
        $appShort = DAXIUM_APP_SHORT;

        return $this->initRequest()->get("/{$appShort}/submissions", ['structure_id' => $id]);
    }

    /**
     * Find a submission by uuid
     *
     * @param  string $uuid
     * @return \stdClass
     */
    public function find(string $uuid): \stdClass
    {
        $appShort = DAXIUM_APP_SHORT;

        return $this->initRequest()->get("/{$appShort}/submissions/{$uuid}");
    }

}
