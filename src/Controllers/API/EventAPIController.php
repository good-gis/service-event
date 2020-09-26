<?php


namespace API\Controllers;


use Controllers\RedisJSONController;
use Exception;
use Helpers\Validate;
use Models\EventModel;

class EventAPIController extends APIController
{
    public string $apiName = 'event';
    protected RedisJSONController $redis;

    /**
     * EventAPIController constructor.
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->redis = new RedisJSONController();
    }


    protected function indexAction()
    {
        var_dump($this->redis->getAllEvent());
    }

    protected function viewAction()
    {
        var_dump($this->formData);
        var_dump('1 notes');
    }

    protected function createAction()
    {
        if (Validate::validateEvent($this->formData)) {
            $eventModel = new EventModel($this->formData);
            $eventModel->saveEvent();
            $this->response($eventModel, 200);
        } else {
            $this->response(['error' => 'Failed create action. Please try later.'], 404);
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