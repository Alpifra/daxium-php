<?php 

namespace Alpifra\DaxiumPHP\Representation;

final class UserRepresentation
{

    public int $id;

    public string $email;

    public bool $active;

    public string $first_name;

    public string $last_name;

    public function __construct(\stdClass $data)
    {
        $this->id = $data->id;
        $this->email = $data->email;
        $this->active = $data->active;
        $this->first_name = $data->first_name;
        $this->last_name = $data->last_name;
    }

}