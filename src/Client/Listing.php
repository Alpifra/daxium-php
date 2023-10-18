<?php

namespace Alpifra\DaxiumPHP\Client;

use Alpifra\DaxiumPHP\BaseClient;
use Alpifra\DaxiumPHP\Representation\ListingRepresentation;


/**
 * List service manager from Daxium API
 * Rename as Listing to avoid restricted PHP word
 * 
 * @see https://doc-dev.daxium-air.com/#listes
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

    /**
     * Add items to a list
     *
     * @param  int $parentId
     * @param  ListingRepresentation[] $items
     * @return ListingRepresentation[]
     */
    public function add(int $parentId, array $items): array
    {
        $lists = [];
        $newLists = [];

        foreach ($items as $item) {
            $lists[] = json_decode( json_encode($item), true );
        }

        $data = $this->initRequest()->patch("/{$this->appShort}/lists/{$parentId}/{$parentId}", $lists);

        foreach ($data->lists as $list) {
            $newLists[] = new ListingRepresentation($list);
        }

        return $newLists;
    }

}
