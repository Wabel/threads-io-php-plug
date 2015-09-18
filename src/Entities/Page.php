<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 19:06
 */

namespace Wabel\ThreadsIo\Entities;


use Wabel\ThreadsIo\Interfaces\PageThreadableInterface;

class Page implements PageThreadableInterface {

    private $pageTitle;
    private $properties;
    private $dateTime;

    public function __construct($pageTitle, $properties = [], \DateTimeImmutable $dateTime = null) {
        $this->setPageTitle($pageTitle);
        $this->setProperties($properties);
        $this->setDateTime($dateTime !== null ? $dateTime : new \DateTimeImmutable());
    }

    /**
     * @return string
     */
    public function getThreadsIoTitle() {
        return $this->getPageTitle();
    }

    public function getThreadsIoProperties() {
        return $this->getProperties();
    }

    public function getThreadsIoDateTime() {
        return $this->getDateTime();
    }

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * @param string $eventId
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
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
     * @param array $dateTime
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }
}