<?php

namespace Alpifra\DaxiumPHP\Client;

use Alpifra\DaxiumPHP\BaseClient;


/**
 * Report service manager from Daxium API
 * 
 * @see https://doc-dev.daxium-air.com/#publipostages
 */
class Report extends BaseClient
{

    /**
     * Find a report by a submission
     *
     * @param  string $uuid
     * @return \stdClass
     */
    public function findBySubmission(string $uuid): \stdClass
    {
        $appShort = DAXIUM_APP_SHORT;

        return $this->initRequest()->get("/{$appShort}/reports", ['submission' => $uuid]);
    }

    /**
     * Download a report
     *
     * @param  int $id
     * @param  string $fileUuid
     * @return string
     */
    public function download(int $id, string $fileUuid): string
    {
        $appShort = DAXIUM_APP_SHORT;

        return $this->initRequest()->getFile("/{$appShort}/reports/{$id}/results/{$fileUuid}");
    }

}
