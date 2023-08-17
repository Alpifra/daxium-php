<?php

namespace Alpifra\DaxiumPHP\Client;

use Alpifra\DaxiumPHP\BaseClient;
use Alpifra\DaxiumPHP\Representation\ListingRepresentation;


/**
 * List service manager from Daxium API
 * Rename as Listing to avoid restricted PHP word
 * 
 * @see https://doc-dev.daxium-air.com/#taches
 */
class Listing extends BaseClient
{

    /**
     * List all lists
     *
     * @return ListingRepresentation[]
     */
    public function list(): array
    {
        $data = $this->initRequest()->get("/{$this->appShort}/lists"); 
        $lists = [];

        foreach ($data->lists as $list) {
            $lists[] = new ListingRepresentation($list);
        }

        return $lists;
    }

    /**
     * Find a list by id
     *
     * @param  int $id
     * @return ListingRepresentation[]
     */
    public function find(int $id): array
    {
        $data = $this->initRequest()->get("/{$this->appShort}/lists/{$id}");
        $lists = [];

        foreach ($data->lists as $list) {
            $lists[] = new ListingRepresentation($list);
        }

        return $lists;
    }

}
