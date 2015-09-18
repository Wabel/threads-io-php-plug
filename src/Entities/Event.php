<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 19:06
 */

namespace Wabel\ThreadsIo\Entities;


use Wabel\ThreadsIo\Interfaces\EventThreadableInterface;

class Event implements EventThreadableInterface {

    private $eventId;
    private $dateTime;
    private $properties;

    public function __construct($eventId, $properties = [], \DateTimeImmutable $datetime = null) {
        $this->setEventId($eventId);
        $this->setProperties($properties);
        $this->setDateTime($datetime !== null ? $datetime : new \DateTimeImmutable());
    }

    /**
     * @return string
     */
    public function getThreadsIoId()
    {
        return $this->getEventId();
    }

    /**
     * @return string
     */
    public function getThreadsIoProperties()
    {
        return $this->getProperties();
    }

    /**
     * @return string
     */
    public function getThreadsIoDateTime()
    {
        return $this->getDateTime();
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
     * @param \DateTimeImmutable $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param array
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }
}