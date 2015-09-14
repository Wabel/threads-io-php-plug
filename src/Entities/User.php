<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 14:29
 */

namespace Wabel\ThreadsIo\Entities;


use Symfony\Component\HttpFoundation\JsonResponse;
use Wabel\ThreadsIo\Interfaces\ThreadableInterface;

/**
 * Class User
 * @package Wabel\Utils\ThreadsIo
 */
class User {
    /**
     * @var ThreadableInterface $user
     */
    private $user;

    /**
     * @param ThreadableInterface $user
     */
    public function __construct(ThreadableInterface $user) {
        $this->setUser($user);
    }

    /**
     * Return an arra
     * @return array
     */
    public function getUserId() {
        return $this->getUser()->getThreadIoId();
    }

    /**
     * Return an arra
     * @return JsonResponse
     */
    public function getTraits() {
        return $this->getUser()->getThreadIoTraits();
    }

    /**
     * @return ThreadableInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param ThreadableInterface $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}