<?php 

namespace Alpifra\DaxiumPHP\Representation;

final class SubmissionRepresentation
{

    public string $id;

    public ?string $task_id = null;

    public ?int $user_id = null;

    public ?int $structure_id = null;

    public \DateTime $created_at;

    public \DateTime $updated_at;

    public int $submission_number;

    public int $number_in_structure;

    /** @var ?array<mixed> */
    public ?array $items = null;

    public function __construct(\stdClass $data)
    {
        $this->id = $data->id;
        $this->task_id = $data->task_id ?? null;
        $this->user_id = $data->user_id ?? null;
        $this->structure_id = $data->structure_id ?? null;
        $this->created_at = new \DateTime("@{$data->created_at}");
        $this->updated_at = new \DateTime("@{$data->updated_at}");
        $this->submission_number = $data->submission_number;
        $this->number_in_structure = $data->number_in_structure;
        $this->items = isset($data->items) ? json_decode(json_encode($data->items), true) : null;
    }

}