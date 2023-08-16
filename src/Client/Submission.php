<?php

namespace Alpifra\DaxiumPHP\Client;

use Alpifra\DaxiumPHP\BaseClient;
use Alpifra\DaxiumPHP\Representation\SubmissionRepresentation;


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
     * @return SubmissionRepresentation[]
     */
    public function listByStructure(int $id): array
    {
        $data = $this->initRequest()->get("/{$this->appShort}/submissions", ['structure_id' => $id]);
        $submissions = [];

        foreach ($data->submissions as $submission) {
            $submissions[] = new SubmissionRepresentation($submission);
        }

        return $submissions;
    }

    /**
     * Find a submission by uuid
     *
     * @param  string $uuid
     * @return SubmissionRepresentation
     */
    public function find(string $uuid): SubmissionRepresentation
    {
        $data = $this->initRequest()->get("/{$this->appShort}/submissions/{$uuid}");

        return new SubmissionRepresentation($data);
    }

}