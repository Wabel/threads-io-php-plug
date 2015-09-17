<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 14:29
 */

namespace Wabel\ThreadsIo\Tests\Entities;

use Wabel\ThreadsIo\Interfaces\ThreadableInterface;

/**
 * Class User
 * @package Wabel\Utils\ThreadsIo
 */
class User implements ThreadableInterface {
    /**
     * @var ThreadableInterface $user
     */
    private $userId;
    private $traits;

    /**
     * @param string $user_id
     * @param array $traits
     */
    public function __construct($user_id, $traits) {
        $this->setUserId($user_id);
        $this->setTraits($traits);
    }

    /**
     * Return an arra
     * @return array
     */
    public function getThreadIoId() {
        return $this->userId;
    }

    /**
     * Return an array
     * @return array
     */
    public function getThreadIoTraits() {
        return $this->traits;
    }

    /**
     * @return ThreadableInterface
     */
    public function setTraits($traits)
    {
        $this->traits = $traits;
    }

    /**
     * @param ThreadableInterface $user
     */
    public function setUserId($user_id)
    {
        $this->user = $user_id;
    }
}