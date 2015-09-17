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

    public function __construct($eventId, $properties, \DateTimeImmutable $datetime = null) {
        $this->setEventId($eventId);
        $this->dateTime = $datetime !== null ? $datetime : new \DateTimeImmutable();
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