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
     * @param \DateTime $datetime
     */
    public function identify(ThreadableInterface $user, $datetime = null) {
        if($datetime === null) {
            $datetime = time();
        }
        elseif($datetime instanceof \DateTime){
            $datetime = $datetime->getTimestamp();
        }
        else {
            throw new ThreadIoPlugException();
        }

        if(!is_array($user->getThreadIoTraits())){
            throw new ThreadIoPlugException();
        }

        $response = $this->getThreadsIoClient()->identify($user->getThreadIoId(), $datetime, $user->getThreadIoTraits());
        return $response->isSuccess();
    }

    /**
     * @param User $user
     * @param \DateTime $datetime
     * @param Event $event
     */
    public function track(ThreadableInterface $user, Event $event, $properties = null, $datetime = null) {
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

        if(!is_array($properties)){
            throw new ThreadIoPlugException();
        }


        $response = $this->getThreadsIoClient()->track($user->getUserId(), $event->getEventId(), $timestamp, $properties);
        return $response->isSuccess();
    }

    /**
     * @param User $user
     * @param \DateTime $datetime
     */
    public function page(Event $event, ThreadableInterface $user, $pageTitle, $properties = null, $datetime = null) {
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

        if(!is_array($properties)){
            throw new ThreadIoPlugException();
        }

        $response = $this->getThreadsIoClient()->page($user->getThreadIoId(), $pageTitle, $properties, $timestamp);
        return $response->isSuccess();
    }

    /**
     * @param User $user
     * @param \DateTime $datetime
     */
    public function remove(ThreadableInterface $user, $datetime = null) {
        if($datetime === null) {
            $timestamp = time();
        }
        elseif($datetime instanceof \DateTime){
            $timestamp = $datetime->getTimestamp();
        }
        else {
            throw new ThreadIoPlugException();
        }

        $response = $this->getThreadsIoClient()->remove($user->getThreadIoTraits(), $timestamp);
        return $response->isSuccess();
    }
}