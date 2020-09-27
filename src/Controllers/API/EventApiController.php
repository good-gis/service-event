<?php

namespace Controllers\API;

use Controllers\RedisController;
use Exception;
use Helpers\Validate;
use JsonException;
use Models\EventModel;
use Views\ApiJsonView;

class EventApiController extends ApiController
{
    public string $apiName = 'event';
    protected RedisController $redis;
    protected EventModel $eventModel;
    protected ApiJsonView $ApiJsonView;

    /**
     * EventApiController constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->redis = new RedisController();
        $this->eventModel = new EventModel();
        $this->ApiJsonView = new ApiJsonView();
    }

    /**
     * получить все event
     */
    protected function indexAction(): void
    {
        $result = $this->eventModel->getAllEvent();
        $this->checkResult($result);
    }

    private function checkResult(array $result): void
    {
        if (!empty($result)) {
            $this->ApiJsonView->response($result, 200);
        } else {
            $this->ApiJsonView->response(['No event found!'], 404);
        }
    }

    protected function viewAction(): void
    {

    }

    /**
     * @throws JsonException
     */
    protected function createAction(): void
    {
        if (Validate::validateEvent($this->formData)) {
            $this->eventModel->setPriority($this->formData['priority']);
            $this->eventModel->setConditions($this->formData['conditions']);
            if ($this->eventModel->saveEvent()) {
                $this->ApiJsonView->response(['Event is create!'], 200);
            }
        } else {
            echo $this->response(['error' => 'Failed create action. Check necessary fields.'], 404);
        }
    }

    protected function updateAction(): void
    {

    }

    protected function deleteAction(): void
    {
        session_destroy();
        $result = $this->redis->deleteAllEvent();
        $this->checkResult($result);
    }
}