<?php

namespace Controllers;

use Averias\RedisJson\Client\RedisJsonClientInterface;
use Averias\RedisJson\Exception\RedisClientException;
use Averias\RedisJson\Factory\RedisJsonClientFactory;
use Helpers\Session;

/**
 * Class RedisController
 * @package Controllers
 */
class RedisController
{
    protected RedisJsonClientInterface $redisClient;
    protected int $jsonCount;

    /**
     * RedisController constructor.
     * @throws RedisClientException
     */
    public function __construct()
    {
        $redisJsonClientFactory = new RedisJsonClientFactory();

        // creates a configured RedisJsonClient
        $this->redisClient = $redisJsonClientFactory->createClient([
            'host' => '127.0.0.1',
            'port' => 6379,
            'timeout' => 0.0, // seconds
            'retryInterval' => 15, // milliseconds
            'readTimeout' => 2, // seconds
            'persistenceId' => null, // string for persistent connections, null for no persistent ones
            'database' => 0 // Redis database index [0..15]
        ]);

        session_start();
    }

    public function setEvent(array $arrData): bool
    {
        Session::setCount();
        var_dump($_SESSION['count']);
        $result = $this->redisClient->jsonSet('event' . $_SESSION['count'], $arrData);
        return $result === true;
    }

    /**
     * @return mixed
     */
    public function getAllEvent()
    {
        $arrResult = [];
        for($i = 0; $i <= $_SESSION['count']; $i++){
            $arrResult[] = $this->redisClient->jsonGet('event' . $i);
        }
        return $arrResult;
    }
}