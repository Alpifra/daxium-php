<?php

namespace Alpifra\DaxiumPHP\Client;

use Alpifra\DaxiumPHP\BaseClient;


/**
 * Task service manager from Daxium API
 * 
 * @see https://doc-dev.daxium-air.com/#taches
 */
class Tasks extends BaseClient
{

    /**
     * List all tasks
     *
     * @return \stdClass
     */
    public function list(): \stdClass
    {
        $appShort = DAXIUM_APP_SHORT;

        return $this->initRequest()->get("/{$appShort}/tasks");
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
        $appShort = DAXIUM_APP_SHORT;
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

        return $this->initRequest()->post("/{$appShort}/tasks", $data);
    }

    /**
     * Remove an existing task
     *
     * @param  string $uuid
     * @return null
     */
    public function remove(string $uuid)
    {
        $appShort = DAXIUM_APP_SHORT;

        return $this->initRequest()->delete("/{$appShort}/tasks/{$uuid}");
    }

}
