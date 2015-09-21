<?php
namespace Wabel\ThreadsIo\Entities;


use Wabel\ThreadsIo\Interfaces\EventThreadableInterface;

/**
 * This class was written to help in the case where you have no classes in your application
 * that could implement the EventThreadableInterface. If you are in this situation, you can
 * instantiate an Event object to be used with the ThreadsIoService.
 *
 * Class Event
 * @package Wabel\ThreadsIo\Entities
 */
class Event implements EventThreadableInterface {

    /**
     * Name of the Event
     * @var string
     */
    private $eventId;

    /**
     * DateTime of when the Event occurs
     * @var \DateTimeImmutable
     */
    private $dateTime;

    /**
     * Parameters attached to the Event
     * @var array
     */
    private $properties;

    /**
     * Event constructor
     * @param string $eventId
     * @param array $properties
     * @param \DateTimeImmutable $datetime
     */
    public function __construct($eventId, $properties = [], \DateTimeImmutable $datetime = null) {
        $this->setEventId($eventId);
        $this->setProperties($properties);
        $this->setDateTime($datetime !== null ? $datetime : new \DateTimeImmutable());
    }

    /**
     * Returns the name of the Threads.io Event you'd like to register
     * @return string
     */
    public function getThreadsIoId()
    {
        return $this->getEventId();
    }

    /**
     * Returns an array of parameters to pass with the Event
     * @return array
     */
    public function getThreadsIoProperties()
    {
        return $this->getProperties();
    }

    /**
     * Returns a DateTimeImmutable of when the Event occured
     * @return \DateTimeImmutable   
     */
    public function getThreadsIoDateTime()
    {
        return $this->getDateTime();
    }

    /**
     * Getter of $eventId
     * @return string
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Setter of $eventId
     * @param string $eventId
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * Getter of $dateTime
     * @return \DateTimeImmutable
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Setter of $dateTime
     * @param \DateTimeImmutable $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * Getter of $properties
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Setter of $properties
     * @param array
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }
}