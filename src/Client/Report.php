<?php

namespace Alpifra\DaxiumPHP\Client;

use Alpifra\DaxiumPHP\BaseClient;
use Alpifra\DaxiumPHP\Representation\ReportRepresentation;


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
     * @return ReportRepresentation[]
     */
    public function findBySubmission(string $uuid): array
    {
        $data = $this->initRequest()->get("/{$this->appShort}/reports", ['submission' => $uuid]);
        $reports = [];

        foreach ($data->reports as $report) {
            $reports[] = new ReportRepresentation($report);
        }

        return $reports;
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
        return $this->initRequest()->getFile("/{$this->appShort}/reports/{$id}/results/{$fileUuid}");
    }

}
