<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 14:26
 */

namespace Wabel\ThreadsIo;


use GuzzleHttp\Client;
use \Wabel\ThreadsIo\Response\Response;

class ThreadsIoClient {

    const IDENTIFY_ACTION = "identify";
    const TRACK_ACTION = "track";
    const VISIT_ACTION = "page";
    const REMOVE_ACTION = "remove";

    /**
     * @var Client
     */
    private $httpClient;
    private $eventKey;

    public function __construct($eventKey) {
        $this->eventKey = $eventKey;

        $this->httpClient = new Client([
            'base_url' => 'https://input.threads.io/v1/',
            'defaults' => ['auth' => [$this->eventKey, ""]]
        ]);
    }

    public function identify($userId, $timestamp, $traits) {
        $request = $this->createRequest(self::IDENTIFY_ACTION, [
            "userId" => $userId,
            "timestamp" => $timestamp,
            "traits" => $traits
        ]);
        return $this->call($request);
    }

    public function track($userId, $event, $timestamp, $properties) {
        $request = $this->createRequest(self::TRACK_ACTION, [
            "userId" => $userId,
            "event" => $event,
            "timestamp" => $timestamp,
            "properties" => $properties
        ]);
        return $this->call($request);
    }
    public function page($userId, $name, $properties, $timestamp) {
        $request = $this->createRequest(self::VISIT_ACTION, [
            "eventKey" => $this->getEventKey(),
            "userId" => $userId,
            "name" => $name,
            "properties" => $properties,
            "timestamp" => $timestamp
        ]);
        return $this->call($request);
    }

    public function remove($userId, $timestamp) {
        $request = $this->createRequest(self::REMOVE_ACTION, [
            "userId" => $userId,
            "timestamp" => $timestamp
        ]);
        return $this->call($request);
    }

    private function call($request) {
        $response = $this->httpClient->send($request);
        return new Response($response->getBody());
    }

    /**
     * @param $action
     * @return \GuzzleHttp\Message\RequestInterface
     */
    private function createRequest($action, $params) {
        return $request = $this->httpClient->createRequest("POST", $action, ["json" => $params]);
    }

    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param Client $httpClient
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return mixed
     */
    public function getEventKey()
    {
        return $this->eventKey;
    }

    /**
     * @param mixed $eventKey
     */
    public function setEventKey($eventKey)
    {
        $this->eventKey = $eventKey;
    }
}