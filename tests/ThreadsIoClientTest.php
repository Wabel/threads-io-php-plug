<?php

class ThreadsIoClientTest extends PHPUnit_Framework_TestCase
{

    public function getClient()
    {
        return new \Wabel\ThreadsIo\ThreadsIoClient($GLOBALS['eventKey']);
    }

    public function testIdentify() {
        $client = $this->getClient();
        $service = new \Wabel\ThreadsIo\ThreadsIoService($client);
        $user = new \Wabel\ThreadsIo\Entities\User('testUser1', [
            "name"=>"Ritchie Blackmore",
            "instrument"=>"Guitar",
            "brands" => [
                "gibson",
                "squier",
                "fender"
            ]
        ]);

        // With no DateTime
        $result = $service->identify($user);
        PHP_CodeCoverage_FilterTest::assertTrue($result, "The user identification works, with auto-generated DateTime!");
        // With DateTime
        $now = new DateTimeImmutable();
        $result = $service->identify($user, $now);
        PHP_CodeCoverage_FilterTest::assertTrue($result, "The user identification works!");
    }
}
