<?php

namespace Wabel\ThreadsIo\Entities;


use Wabel\ThreadsIo\Interfaces\UserThreadableInterface;

/**
 * This class was written to help in the case where you have no classes in your application
 * that could implement the UserThreadableInterface. If you are in this situation, you can
 * instantiate a User object to be used with the ThreadsIoService.
 *
 * Class User
 * @package Wabel\ThreadsIo\Entities
 */
class User implements UserThreadableInterface {

    /**
     * User ID made of alphanumerical characters
     * @var string
     */
    private $userId;

    /**
     * Traits represents parameters to associate with the User
     * @var array
     */
    private $traits;

    /**
     * User constructor
     * @param string $userId
     * @param array $traits
     */
    public function __construct($userId, $traits = []) {
        $this->setUserId($userId);
        $this->setTraits($traits);
    }

    /**
     * Returns the unique ID of the Threads.io User you'd like to register
     * @return string
     */
    public function getThreadIoId() {
        return $this->getUserId();
    }

    /**
     * Returns an array of parameters to associated to the User
     * @return array
     */
    public function getThreadIoTraits() {
        return $this->getTraits();
    }

    /**
     * Getter of $userId
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Setter of $userId
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Getter of $traits
     * @return array
     */
    public function getTraits()
    {
        return $this->traits;
    }

    /**
     * Setter of $traits
     * @param array $traits
     */
    public function setTraits($traits)
    {
        $this->traits = $traits;
    }
}