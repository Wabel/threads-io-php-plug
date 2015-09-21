<?php

namespace Wabel\ThreadsIo\Entities;

use Wabel\ThreadsIo\Interfaces\PageThreadableInterface;

/**
 * This class was written to help in the case where you have no classes in your application
 * that could implement the PageThreadableInterface. If you are in this situation, you can
 * instantiate a Page object to be used with the ThreadsIoService.
 *
 * Class Page
 * @package Wabel\ThreadsIo\Entities
 */
class Page implements PageThreadableInterface {

    /**
     * Title of the page
     * @var string
     */
    private $pageTitle;

    /**
     * Properties concerning the current page
     * @var array
     */
    private $properties;

    /**
     * DateTime of when the Page is visited
     * @var \DateTimeImmutable
     */
    private $dateTime;

    /**
     * Page constructor
     * @param string $pageTitle
     * @param array $properties
     * @param \DateTimeImmutable $dateTime
     */
    public function __construct($pageTitle, $properties = [], \DateTimeImmutable $dateTime = null) {
        $this->setPageTitle($pageTitle);
        $this->setProperties($properties);
        $this->setDateTime($dateTime !== null ? $dateTime : new \DateTimeImmutable());
    }

    /**
     * Returns the name of the Threads.io Page the user just visited
     * @return string
     */
    public function getThreadsIoTitle() {
        return $this->getPageTitle();
    }

    /**
     * Returns an array of parameters to pass with the Page visit
     * @return array
     */
    public function getThreadsIoProperties() {
        return $this->getProperties();
    }

    /**
     * Returns a DateTimeImmutable of when the Page was visited
     * @return \DateTime
     */
    public function getThreadsIoDateTime() {
        return $this->getDateTime();
    }

    /**
     * Getter of $pageTitle
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Setter of $pageTitle
     * @param string $pageTitle
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * Getter of $dateTime
     * @return \DateTime
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
     * @param array $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }
}