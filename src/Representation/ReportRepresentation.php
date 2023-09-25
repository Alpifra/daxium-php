<?php 

namespace Alpifra\DaxiumPHP\Representation;

final class ReportRepresentation
{

    public int $id;

    public string $status;

    public ?string $file_uuid;

    public ?string $file_name;

    public function __construct(\stdClass $data)
    {
        $this->id = $data->id;
        $this->status = $data->status;

        if ($data->pdf_document->file_uuid) {
            $this->file_uuid = $data->pdf_document->file_uuid;
            $this->file_name = $data->pdf_document->file_name;
        } else {
            $this->file_uuid = $data->original_document->file_uuid;
            $this->file_name = $data->original_document->file_name;
        }
    }

}