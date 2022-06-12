<?php

namespace App\Utils;

use App\Utils\TokenCache;
use Microsoft\Graph\Graph;

class GraphApiHandle
{
    /**
     * Get the access token from the cache
     * @return void $tokenCache
     */
    public static function getAccessToken()
    {
        // Get the access token from the cache
        $tokenCache = new TokenCache();
        return $tokenCache->getAccessToken();
    }

    /**
     * Execute Get Api
     *
     * @param  mixed $eventUrl
     * @param  mixed $queryParams
     * @return void
     */
    public static function executeGetApi($modelClass, $eventUrl, $otion, $value)
    {
        // Create a Graph client
        $graph = new Graph();
        $graph->setAccessToken(self::getAccessToken());

        $queryParams = array(
            $otion => $value,
        );

        // Append query parameters to the url events
        $getEventsUrl = $eventUrl . http_build_query($queryParams);
        return $graph->createRequest('GET', $getEventsUrl)
            ->addHeaders(array("Content-Type" => "application/json"))
            ->setReturnType($modelClass)
            ->execute();
    }

    /**
     * Execute POST Api
     *
     * @param  mixed $modelClass
     * @param  mixed $eventUrl
     * @param  mixed $data
     * @return void
     */
    public static function executePostApi($modelClass, $eventUrl, $data)
    {
        // Create a Graph client
        $graph = new Graph();
        $graph->setAccessToken(self::getAccessToken());

        return $graph->createRequest("POST", $eventUrl)
            ->addHeaders(array("Content-Type" => "application/json"))
            ->attachBody($data)
            ->setReturnType($modelClass)
            ->execute();
    }

    /**
     * Execute Path Api
     *
     * @param  mixed $modelClass
     * @param  mixed $eventUrl
     * @param  mixed $id
     * @param  mixed $data
     * @return void
     */
    public static function executePathApi($modelClass, $eventUrl, $data)
    {
        // Create a Graph client
        $graph = new Graph();
        $graph->setAccessToken(self::getAccessToken());

        return $graph->createRequest("PATCH ", $eventUrl . $data['id'])
            ->addHeaders(array("Content-Type" => "application/json"))
            ->attachBody($data)
            ->setReturnType($modelClass)
            ->execute();
    }

    /**
     * Execute Delete Api
     *
     * @param  mixed $modelClass
     * @param  mixed $eventUrl
     * @param  mixed $id
     * @return void
     */
    public static function executeDeleteApi($modelClass, $eventUrl, $id)
    {
        // Create a Graph client
        $graph = new Graph();
        $graph->setAccessToken(self::getAccessToken());

        return $graph->createRequest("DELETE", $eventUrl . $id)
            ->addHeaders(array("Content-Type" => "application/json"))
            ->setReturnType($modelClass)
            ->execute();
    }

}
