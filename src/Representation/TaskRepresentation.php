<?php 

namespace Alpifra\DaxiumPHP\Representation;

final class TaskRepresentation
{

    public string $id;

    public ?int $user_id = null;

    public ?int $duration = null;

    public \DateTime $created_at;

    public \DateTime $updated_at;

    public \DateTime $start_date;

    public \DateTime $due_date;

    public string $time_status;

    public string $fill_status;

    public function __construct(\stdClass $data)
    {
        $this->id = $data->id;
        $this->user_id = $data->user_id ?? null;
        $this->duration = $data->duration ?? null;
        $this->created_at = new \DateTime("@{$data->created_at}");
        $this->updated_at = new \DateTime("@{$data->updated_at}");
        $this->start_date = new \DateTime("@{$data->start_date}");
        $this->due_date = new \DateTime("@{$data->due_date}");
        $this->time_status = $data->time_status;
        $this->fill_status = $data->fill_status;
    }

}