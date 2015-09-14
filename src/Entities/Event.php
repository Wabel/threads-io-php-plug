<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 19:06
 */

namespace Wabel\ThreadsIo\Entities;


class Event {

    private $eventId;
    private $dateTime;

    public function __construct($eventId, \DateTime $datetime) {
        $this->eventId = $eventId;
        $this->dateTime = $datetime;
    }

    /**
     * @return string
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @param string $eventId
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param \DateTime $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }
}