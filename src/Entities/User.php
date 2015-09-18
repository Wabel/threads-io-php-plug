<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 19:06
 */

namespace Wabel\ThreadsIo\Entities;


use Wabel\ThreadsIo\Interfaces\UserThreadableInterface;

class User implements UserThreadableInterface {

    private $userId;
    private $traits;

    public function __construct($userId, $traits = []) {
        $this->setUserId($userId);
        $this->setTraits($traits);
    }

    public function getThreadIoId() {
        return $this->getUserId();
    }

    public function getThreadIoTraits() {
        return $this->getTraits();
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return array
     */
    public function getTraits()
    {
        return $this->traits;
    }

    /**
     * @param array $dateTime
     */
    public function setTraits($traits)
    {
        $this->traits = $traits;
    }
}