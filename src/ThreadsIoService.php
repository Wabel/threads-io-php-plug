<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 14:19
 */

namespace Wabel\Utils\ThreadsIo;


/**
 * Class ThreadsIoService
 * @package Wabel\Utils\ThreadsIo
 */
class ThreadsIoService {

    /**
     * @var
     */
    private $threadsIoClient;

    /**
     * @param $threadsIoClient
     */
    function __construct($threadsIoClient)
    {
        $this->threadsIoClient = $threadsIoClient;
    }

    /**
     * @return mixed
     */
    public function getThreadsIoClient()
    {
        return $this->threadsIoClient;
    }

    /**
     * @param mixed $threadsIoClient
     */
    public function setThreadsIoClient($threadsIoClient)
    {
        $this->threadsIoClient = $threadsIoClient;
    }

    /**
     * @param ThreadableInterface $user
     * @return User
     */
    public function getThreadsIoUser (ThreadableInterface $user) {
        return new User($user);
    }

    /**
     * @param User $user
     */
    public function identify(User $user) {

    }
}