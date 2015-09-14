<?php

class ThreadsIoClientTest extends PHPUnit_Framework_TestCase
{

    public function getClient()
    {
        return new \Wabel\ThreadsIo\ThreadsIoClient($GLOBALS['eventKey']);
    }
}
