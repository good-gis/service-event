<?php


namespace API\Controllers;


use Controllers\RedisController;
use Exception;
use Helpers\Validate;
use Models\EventModel;

class EventApiController extends ApiController
{
    public string $apiName = 'event';
    protected RedisController $redis;
    protected EventModel $eventModel;

    /**
     * EventApiController constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->redis = new RedisController();
        $this->eventModel = new EventModel();
    }

    /**
     * получить все event
     */
    protected function indexAction()
    {
         echo $this->eventModel->getAllEvent();
    }

    protected function viewAction()
    {
        var_dump($this->formData);
        var_dump('1 notes');
    }

    protected function createAction()
    {
        if (Validate::validateEvent($this->formData)) {
            $this->eventModel->setPriority($this->formData['priority']);
            $this->eventModel->setConditions($this->formData['conditions']);
            echo $this->eventModel->saveEvent();
        } else {
            echo $this->response(['error' => 'Failed create action. Check necessary fields.'], 404);
        }
    }

    protected function updateAction()
    {
        var_dump('update notes');
    }

    protected function deleteAction()
    {
        var_dump($this->formData);
        var_dump('delete notes');
    }
}