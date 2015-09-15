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
     * @var Client $httpClient
     */
    private $httpClient;
    private $eventKey;

    public function __construct($eventKey, Client $httpClient) {
        $this->httpClient = $httpClient;
        $this->eventKey = $eventKey;
    }

    public function __construct(Client $httpClient) {
        $this->httpClient;
    }

    public function identify($userId, $timestamp, $traits) {
        $request = $this->createRequest(self::IDENTIFY_ACTION);
        $request->getBody()->setField("userId", $userId);
        $request->getBody()->setField("timestamp", $timestamp);
        $request->getBody()->setField("traits", $traits);
        return $this->call($request);
    }

    public function track($userId, $event, $timestamp, $properties) {
        $request = $this->createRequest(self::TRACK_ACTION);
        $request->getBody()->setField("userId", $userId);
        $request->getBody()->setField("event", $event);
        $request->getBody()->setField("timestamp", $timestamp);
        $request->getBody()->setField("properties", $properties);
        return $this->call($request);
    }

    public function page($eventKey, $userId, $name, $properties, $timestamp) {
        $request = $this->createRequest(self::VISIT_ACTION);
        $request->getBody()->setField("eventKey", $eventKey);
        $request->getBody()->setField("userId", $userId);
        $request->getBody()->setField("name", $name);
        $request->getBody()->setField("properties", $properties);
        $request->getBody()->setField("timestamp", $timestamp);
        return $this->call($request);
    }

    public function remove($userId, $timestamp) {
        $request = $this->createRequest(self::REMOVE_ACTION);
        $request->getBody()->setField("userId", $userId);
        $request->getBody()->setField("timestamp", $timestamp);
        return $this->call($request);
    }

    private function createRequest($action) {
        return $request = $this->httpClient->createRequest("POST", $action, ['auth' => [$this->eventKey]]);
    }

    private function call($request) {
        $response = $this->httpClient->send($request);
        return new Response($response->getBody());
    }
}