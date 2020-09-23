<?php


namespace Controllers;



class RedisJSONController
{

    /**
     * RedisJSONController constructor.
     */
    public function __construct()
    {
        $redisJsonClientFactory = new Redis();
    }
}