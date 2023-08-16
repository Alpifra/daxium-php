<?php

namespace Alpifra\DaxiumPHP\Client;

use Alpifra\DaxiumPHP\BaseClient;
use Alpifra\DaxiumPHP\Representation\TaskRepresentation;

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
     * @return TaskRepresentation[]
     */
    public function list(): array
    {
        $data = $this->initRequest()->get("/{$this->appShort}/tasks"); 
        $tasks = [];

        foreach ($data->tasks as $task) {
            $tasks[] = new TaskRepresentation($task);
        }

        return $tasks;
    }

    /**
     * Create a new task
     *
     * @param  int $user
     * @param  \DateTime $startAt
     * @param  \DateTime $endAt
     * @param  ?array<array-key, string> $submissions
     * @return TaskRepresentation
     */
    public function create(int $user, \DateTime $startAt, \DateTime $endAt, ?array $submissions = null): TaskRepresentation
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

        $data = $this->initRequest()->post("/{$this->appShort}/tasks", $data);

        return new TaskRepresentation($data);
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
