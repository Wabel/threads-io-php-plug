<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 14:26
 */

namespace Wabel\ThreadsIo;


use GuzzleHttp\Client;

class ThreadsIoClient {

    const IDENTIFY_ACTION = "identify";
    const TRACK_ACTION = "track";
    const VISIT_ACTION = "page";
    const REMOVE_ACTION = "remove";

    /**
     * @var Client
     */
    private $httpClient;

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
        return $request = $this->httpClient->createRequest("POST", $action);
    }

    private function call($request) {
        $response = $this->httpClient->send($request);

        $zohoResponse =  new Response($response->getBody()->__toString(), $module, $command);

        if ($zohoResponse->ifSuccess()) {
            return $zohoResponse;
        } else {
            throw new ZohoCRMResponseException($zohoResponse);
        }

    }
}