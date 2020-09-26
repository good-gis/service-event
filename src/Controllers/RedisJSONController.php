<?php

namespace Controllers;

use Averias\RedisJson\Client\RedisJsonClientInterface;
use Averias\RedisJson\Exception\RedisClientException;
use Averias\RedisJson\Factory\RedisJsonClientFactory;

/**
 * Class RedisJSONController
 * @package Controllers
 */
class RedisJSONController
{
    protected RedisJsonClientInterface $redisClient;

    /**
     * RedisJSONController constructor.
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
    }

    public function setEvent(array $arrData)
    {
        $this->redisClient->jsonSet('event', $arrData);
    }

    public function getAllEvent()
    {
        $this->redisClient->jsonGet('event');
    }
}