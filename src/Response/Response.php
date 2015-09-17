<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 18:34
 */

namespace Wabel\ThreadsIo\Response;


class Response {
    private $response;


    public function __construct($response) {
        $this->setResponse($response);
    }
    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function isSuccess()
    {
        $response = json_decode($this->getResponse());
        return isset($response->success) ? $response->success : false;
    }
}