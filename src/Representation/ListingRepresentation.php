<?php 

namespace Alpifra\DaxiumPHP\Representation;

final class ListingRepresentation
{

    public ?int $id = null;

    public ?int $parent_id = null;

    public ?int $root_id = null;

    public string $name;

    public ?string $external_id = null;

    public ?int $position = null;

    public ?int $level = null;

    public ?string $functionnal_status_color = null;

    public ?string $url = null;

    public ?bool $has_image = null;

    public \DateTime $created_at;

    public ?\DateTime $updated_at;

    public function __construct(\stdClass $data)
    {
        $this->id = $data->id ?? null;
        $this->parent_id = $data->parent_id ?? null;
        $this->root_id = $data->root_id ?? null;
        $this->name = $data->name;
        $this->external_id = $data->external_id ?? null;
        $this->position = $data->position ?? null;
        $this->level = $data->level ?? null;
        $this->functionnal_status_color = $data->functionnal_status_color ?? null;
        $this->url = $data->url ?? null;
        $this->has_image = $data->has_image ?? null;
        $this->created_at = new \DateTime("@{$data->created_at}");
        $this->updated_at = isset($updated_at) ? new \DateTime("@{$data->updated_at}") : null;
    }

}