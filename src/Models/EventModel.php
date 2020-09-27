<?php

namespace Models;

use Controllers\RedisController;
use JsonException;

class EventModel
{
    protected RedisController $redisController;
    protected int $priority;
    protected array $conditions;

    /**
     * EventModel constructor.
     * @param array $body
     */
    public function __construct(array $body = [])
    {
        $this->redisController = new RedisController();
        if (!empty($body)) {
            $this->priority = $body['priority'];
            $this->conditions = $body['conditions'];
        }
    }

    public function saveEvent(): bool
    {
        return $this->redisController->setEvent([
            'priority' => $this->priority,
            'conditions' => $this->conditions
        ]);
    }

    /**
     * @return false|string
     * @throws JsonException
     */
    public function getAllEvent()
    {
        return json_encode($this->redisController->getAllEvent(), JSON_THROW_ON_ERROR);
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @return array
     */
    public function getConditions(): array
    {
        return $this->conditions;
    }

    /**
     * @param array $conditions
     */
    public function setConditions(array $conditions): void
    {
        $this->conditions = $conditions;
    }


}