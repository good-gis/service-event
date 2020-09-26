<?php

namespace Models;

use Controllers\RedisJSONController;

class EventModel
{
    protected RedisJSONController $redisController;
    protected int $priority;
    protected array $conditions;

    /**
     * EventModel constructor.
     * @param array $body
     */
    public function __construct(array $body = [])
    {
        $this->redisController = new RedisJSONController();
        if (!empty($body)) {
            $this->priority = $body['priority'];
            $this->conditions = $body['conditions'];
        }
    }

    public function saveEvent()
    {
        $this->redisController->setEvent([
            'priority' => $this->priority,
            'conditions' => $this->conditions
        ]);
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