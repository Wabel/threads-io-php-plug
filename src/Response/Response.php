<?php

namespace Wabel\ThreadsIo\Response;


/**
 * Basic Response handler for the package
 *
 * Class Response
 * @package Wabel\ThreadsIo\Response
 */
class Response {

    /**
     * An array representing the JSON response
     * @var array
     */
    private $response;

    /**
     * Response constructor
     * @param string $response A string formatted in JSON
     */
    public function __construct($response) {
        $this->setResponse(json_decode($response));
    }

    /**
     * Getter of $response
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Setter of $response
     * @param array $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * Returns whether or not the API call is a success.
     * @return bool
     */
    public function isSuccess()
    {
        $response = $this->getResponse();
        return isset($response->success) ? $response->success : false;
    }
}