<?php

namespace Alpifra\DaxiumPHP\Client;

use Alpifra\DaxiumPHP\BaseClient;


/**
 * Task service manager from Daxium API
 * 
 * @see https://doc-dev.daxium-air.com/#taches
 */
class Task extends BaseClient
{

    /**
     * List all tasks
     *
     * @return \stdClass
     */
    public function list(): \stdClass
    {
        return $this->initRequest()->get("/{$this->appShort}/tasks");
    }

    /**
     * Create a new task
     *
     * @param  int $user
     * @param  \DateTime $startAt
     * @param  \DateTime $endAt
     * @param  ?array<array-key, string> $submissions
     * @return \stdClass
     */
    public function create(int $user, \DateTime $startAt, \DateTime $endAt, ?array $submissions = null): \stdClass
    {
        $start = $startAt->getTimestamp();
        $end = $endAt->getTimestamp();
        $data = [
            'start_date'   => $start,
            'due_date'     => $end,
            'user_id'      => $user,
            'duration'     => $end - $start,
            'delay_before' => 0,
            'delay_after'  => 0
        ];

        if ($submissions) $data['submissions'] = $submissions;

        return $this->initRequest()->post("/{$this->appShort}/tasks", $data);
    }

    /**
     * Remove an existing task
     *
     * @param  string $uuid
     * @return null
     */
    public function remove(string $uuid)
    {
        return $this->initRequest()->delete("/{$this->appShort}/tasks/{$uuid}");
    }

}
