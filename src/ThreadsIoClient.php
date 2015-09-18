<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 14:26
 */

namespace Wabel\ThreadsIo;


use GuzzleHttp\Client;
use Wabel\ThreadsIo\Exceptions\ThreadsIoPlugException;
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
        $this->setEventKey($eventKey);

        $this->setHttpClient(new Client([
            'base_url' => 'https://input.threads.io/v1/',
            'defaults' => ['auth' => [$this->getEventKey(), ""]]
        ]));
    }

    public function identify($userId, \DateTimeImmutable $datetime, $traits) {

        if(!is_array($traits)){
            throw new ThreadsIoPlugException("The traits you passed to the user are wrong. Please verify its format (array) or values.");
        }

        $params = [
            "userId" => $userId,
            "timestamp" => $this->formatDate($datetime),
            "traits" => $traits
        ];
        $request = $this->createRequest(self::IDENTIFY_ACTION, $params);
        return $this->call($request);
    }

    public function track($userId, $event,\DateTimeImmutable $datetime, $properties) {

        if(!is_array($properties)){
            throw new ThreadsIoPlugException("The properties you passed to the tracking function are wrong. Please verify its format (array) or values.");
        }

        $request = $this->createRequest(self::TRACK_ACTION, [
            "userId" => $userId,
            "event" => $event,
            "timestamp" => $this->formatDate($datetime),
            "properties" => $properties
        ]);
        return $this->call($request);
    }

    public function page($userId, $name, $properties,\DateTimeImmutable $datetime) {

        if(!is_array($properties)){
            throw new ThreadsIoPlugException("The properties you passed to the page function are wrong. Please verify its format (array) or values.");
        }

        $request = $this->createRequest(self::VISIT_ACTION, [
            "eventKey" => $this->getEventKey(),
            "userId" => $userId,
            "name" => $name,
            "properties" => $properties,
            "timestamp" => $this->formatDate($datetime)
        ]);
        return $this->call($request);
    }

    public function remove($userId,\DateTimeImmutable $datetime) {
        $request = $this->createRequest(self::REMOVE_ACTION, [
            "timestamp" => $this->formatDate($datetime),
            "userId" => $userId
        ]);
        return $this->call($request);
    }

    private function call($request) {
        $response = $this->getHttpClient()->send($request);
        return new Response($response->getBody());
    }

    private function formatDate(\DateTimeImmutable $datetime) {
        return  str_replace('+00:00', '.000Z', $datetime->setTimezone(new \DateTimeZone('UTC'))->format('c'));
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