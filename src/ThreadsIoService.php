<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 14:19
 */

namespace Wabel\ThreadsIo;
use Wabel\ThreadsIo\Entities\User;
use Wabel\ThreadsIo\Exceptions\ThreadsIoPlugException;
use Wabel\ThreadsIo\Interfaces\ThreadableInterface;
use Wabel\ThreadsIo\Entities\Event;


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
     * @param ThreadsIoClient $threadsIoClient
     */
    function __construct($threadsIoClient)
    {
        $this->threadsIoClient = $threadsIoClient;
    }

    /**
     * @return ThreadsIoClient
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
        $this->setThreadsIoClient($threadsIoClient);
    }

    /**
     * @param ThreadableInterface $user
     * @param \DateTimeImmutable $datetime
     */
    public function identify(ThreadableInterface $user, \DateTimeImmutable $datetime = null) {
        if($datetime === null) {
            $datetime = new \DateTimeImmutable();
        }

        if(!is_array($user->getThreadIoTraits())){
            throw new ThreadsIoPlugException("The traits you passed to the user are wrong. Please verify its format and value.");
        }

        $response = $this->getThreadsIoClient()->identify($user->getThreadIoId(), $datetime, $user->getThreadIoTraits());
        return $response->isSuccess();
    }

    /**
     * @param User $user
     * @param \DateTime $datetime
     * @param Event $event
     */
    public function track(ThreadableInterface $user, Event $event, $properties = null, \DateTimeImmutable $datetime = null) {
        if($event->getDateTime()) {
            $datetime = $event->getDateTime();
        }
        elseif($datetime === null) {
            $datetime = new \DateTimeImmutable();
        }

        if(!is_array($properties)){
            throw new ThreadsIoPlugException("The properties you passed to the tracking function are wrong. Please verify its format and value.");
        }


        $response = $this->getThreadsIoClient()->track($user->getThreadIoId(), $event->getEventId(), $datetime, $properties);
        return $response->isSuccess();
    }

    /**
     * @param User $user
     * @param \DateTimeImmutable $datetime
     */
    public function page(ThreadableInterface $user, $pageTitle, $properties = null, \DateTimeImmutable $datetime = null) {

        if($datetime === null) {
            $datetime = new \DateTimeImmutable();
        }

        if(!is_array($properties)){
            throw new ThreadsIoPlugException();
        }

        $response = $this->getThreadsIoClient()->page($user->getThreadIoId(), $pageTitle, $properties, $datetime);
        return $response->isSuccess();
    }

    /**
     * @param User $user
     * @param \DateTimeImmutable $datetime
     */
    public function remove(ThreadableInterface $user, \DateTimeImmutable $datetime = null) {

        if($datetime === null) {
            $datetime = new \DateTimeImmutable();
        }

        $response = $this->getThreadsIoClient()->remove($user->getThreadIoId(), $datetime);
        return $response->isSuccess();
    }
}