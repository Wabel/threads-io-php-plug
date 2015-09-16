<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 14:19
 */

namespace Wabel\ThreadsIo;
use Wabel\ThreadsIo\Entities\User;
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
     * @param \DateTime $datetime
     */
    public function identify(User $user, $datetime = null) {
        if($datetime === null) {
            $datetime = time();
        }
        elseif($datetime instanceof \DateTime){
            $datetime = $datetime->getTimestamp();
        }
        else {
            throw new ThreadIoPlugException();
        }

        $traits = json_encode($user->getTraits());

        $response = $this->getThreadsIoClient()->identify($user->getUserId(), $datetime, $traits);
        return $response->isSuccess();
    }

    /**
     * @param User $user
     * @param \DateTime $datetime
     * @param Event $event
     */
    public function track(User $user, Event $event, $properties = null, $datetime = null) {
        if($datetime === null) {
            if($event->getDateTime()) {
                $timestamp = $event->getDateTime()->getTimestamp();
            }
            else {
                $timestamp = time();
            }
        }
        elseif($datetime instanceof \DateTime){
            $timestamp = $datetime->getTimestamp();
        }
        else {
            throw new ThreadIoPlugException();
        }

        if(is_array($properties)){
            $properties = json_encode($properties);
        }
        else {
            throw new ThreadIoPlugException();
        }


        $response = $this->getThreadsIoClient()->track($user->getUserId(), $event->getEventId(), $timestamp, $properties);
        return $response->isSuccess();
    }

    /**
     * @param User $user
     * @param \DateTime $datetime
     */
    public function page(Event $event, User $user, $pageTitle, $properties = null, $datetime = null) {
        if($datetime === null) {
            if($event->getDateTime()) {
                $timestamp = $event->getDateTime()->getTimestamp();
            }
            else {
                $timestamp = time();
            }
        }
        elseif($datetime instanceof \DateTime){
            $timestamp = $datetime->getTimestamp();
        }
        else {
            throw new ThreadIoPlugException();
        }

        if(is_array($properties)){
            $properties = json_encode($properties);
        }
        else {
            throw new ThreadIoPlugException();
        }

        $properties = json_encode($properties);

        $response = $this->getThreadsIoClient()->page($event->getEventId(), $user->getUserId(), $pageTitle, $properties, $timestamp);
        return $response->isSuccess();
    }

    /**
     * @param User $user
     * @param \DateTime $datetime
     */
    public function remove(User $user, $datetime = null) {
        if($datetime === null) {
            $timestamp = time();
        }
        elseif($datetime instanceof \DateTime){
            $timestamp = $datetime->getTimestamp();
        }
        else {
            throw new ThreadIoPlugException();
        }

        $response = $this->getThreadsIoClient()->remove($user->getUserId(), $timestamp);
        return $response->isSuccess();
    }
}