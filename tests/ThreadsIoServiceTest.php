<?php
namespace Wabel\Zoho\CRM\Service;


use Psr\Log\NullLogger;
use Wabel\ThreadsIo\Entities\Event;
use Wabel\ThreadsIo\Entities\User;
use Wabel\ThreadsIo\ThreadsIoService;
use Wabel\Zoho\CRM\ZohoClient;

class ThreadsIoServiceTest extends \PHPUnit_Framework_TestCase {

    public function getClient()
    {
        return new \Wabel\ThreadsIo\ThreadsIoClient($GLOBALS['eventKey']);
    }

    public function testIdentify() {
        $client = $this->getClient();
        $service = new ThreadsIoService($client);
        $user = new User('testUser1', [
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
        $this->assertTrue($result, "The user identification works, with auto-generated DateTime!");
        // With DateTime
        $now = new \DateTimeImmutable();
        $result = $service->identify($user, $now);
        $this->assertTrue($result, "The user identification works!");
    }

    public function testTrack() {
        $now = new \DateTimeImmutable();

        $client = $this->getClient();
        $service = new ThreadsIoService($client);
        $event = new Event("Connected");
        $user = new User('testUser1', [
            "name"=>"Ritchie Blackmore",
            "instrument"=>"Guitar",
            "brands" => [
                "gibson",
                "squier",
                "fender"
            ]
        ]);

        // With no DateTime
        $result = $service->track($user, $event, ["method"=>"test", "status"=>"ok"]);
        $this->assertTrue($result, "The user tracking works, with auto-generated DateTime!");
        // With DateTime
        $result = $service->track($user, $event, ["method"=>"test", "status"=>"ok"], $now);
        $this->assertTrue($result, "The user identification works!");
    }

    public function testPage() {
        $now = new \DateTimeImmutable();

        $client = $this->getClient();
        $service = new ThreadsIoService($client);
        $user = new User('testUser1', [
            "name"=>"Ritchie Blackmore",
            "instrument"=>"Guitar",
            "brands" => [
                "gibson",
                "squier",
                "fender"
            ]
        ]);

        // With no DateTime
        $result = $service->page($user, "The Big Page", ["url"=>"http://www.wabel.com", "referer"=>"http://www.google.com"], $now);
        $this->assertTrue($result, "The user identification works, with auto-generated DateTime!");
        // With DateTime
        $result = $service->page($user, "The Big Page", ["url"=>"http://www.wabel.com", "referer"=>"http://www.google.com"]);
        $this->assertTrue($result, "The user identification works!");
    }

    public function testRemove() {
        $client = $this->getClient();
        $service = new ThreadsIoService($client);
        $user = new User('testUser1', [
            "name"=>"Ritchie Blackmore",
            "instrument"=>"Guitar",
            "brands" => [
                "gibson",
                "squier",
                "fender"
            ]
        ]);

        // With no DateTime
        $result = $service->remove($user);
        $this->assertTrue($result, "The user identification works, with auto-generated DateTime!");
        // With DateTime
        $now = new \DateTimeImmutable();
        $result = $service->remove($user, $now);
        $this->assertTrue($result, "The user identification works!");
    }
}
