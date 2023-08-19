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

    /**
     * Create a new submission
     *
     * @param  string $structureId
     * @param  string $structureVersion
     * @param  array<string, array<array-key, mixed>> $items with the system name field as key and the values as array. Exemple ['systemKey' => ['value']]
     * @param  bool $partial
     * @return SubmissionRepresentation
     */
    public function create(int $structureId, int $structureVersion, array $items, bool $partial = false): SubmissionRepresentation
    {
        $partial = $partial ? 'true' : 'false';

        $data = $this->initRequest()->post("/{$this->appShort}/submissions", [
            'partial'           => $partial,
            'structure_id'      => $structureId,
            'structure_version' => $structureVersion,
            'items'             => $items
        ]);

        return new SubmissionRepresentation($data);
    }

}