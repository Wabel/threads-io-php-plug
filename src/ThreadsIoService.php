<?php
/**
 * This was developed by the Tech Team of Wabel.com
 * Author : Michael WIZMAN
 * Contact : micahelwizman@hotmail.com
 */

namespace Wabel\ThreadsIo;
use Wabel\ThreadsIo\Entities\User;
use Wabel\ThreadsIo\Exceptions\ThreadsIoPlugException;
use Wabel\ThreadsIo\Interfaces\EventThreadableInterface;
use Wabel\ThreadsIo\Interfaces\PageThreadableInterface;
use Wabel\ThreadsIo\Interfaces\UserThreadableInterface;
use Wabel\ThreadsIo\Entities\Event;


/**
 * This is the class that should be used to communicate easily with your Threads.io account
 * It supports the following methods :
 * - Identify : Register to Threads.io a User with a specific ID, necessary to track users page views and events.
 * - Track : Register a new Event that happened on your application for a specific User in Threads.io
 * - Page : Register a new Page seen by a User on Threads.io
 * - Remove : Delete a User you registered from Threads.io
 *
 * Class ThreadsIoService
 * @package Wabel\Utils\ThreadsIo
 */
class ThreadsIoService {

    /**
     * An instance of the ThreadsIoClient
     *
     * @var ThreadsIoClient
     */
    private $threadsIoClient;

    /**
     * Constructor
     *
     * @param ThreadsIoClient $threadsIoClient
     */
    function __construct(ThreadsIoClient $threadsIoClient)
    {
        $this->setThreadsIoClient($threadsIoClient);
    }

    /**
     * Identifies a User from the application into Threads.io
     *
     * @param UserThreadableInterface $user
     * @param \DateTimeImmutable $datetime
     *
     * @throws ThreadsIoPlugException
     * @return bool
     */
    public function identify(UserThreadableInterface $user, \DateTimeImmutable $datetime = null) {
        if($datetime === null) {
            $datetime = new \DateTimeImmutable();
        }

        $response = $this->getThreadsIoClient()->identify($user->getThreadIoId(), $datetime, $user->getThreadIoTraits());
        return $response->isSuccess();
    }

    /**
     * @param UserThreadableInterface $user
     * @param Event $event
     * @param \DateTimeImmutable $datetime
     * @throws ThreadsIoPlugException
     * @return bool
     */
    public function track(UserThreadableInterface $user, EventThreadableInterface $event, \DateTimeImmutable $datetime = null) {
        if($datetime === null) {
            $datetime = $event->getThreadsIoDateTime();
        }

        $response = $this->getThreadsIoClient()->track($user->getThreadIoId(), $event->getThreadsIoId(), $datetime, $event->getThreadsIoProperties());
        return $response->isSuccess();
    }

    /**
     * @param User $user
     * @param \DateTimeImmutable $datetime
     * @throws ThreadsIoPlugException
     * @return bool
     */
    public function page(UserThreadableInterface $user, PageThreadableInterface $visit, \DateTimeImmutable $datetime = null) {

        if($datetime === null) {
            $datetime = $visit->getThreadsIoDateTime();
        }

        $response = $this->getThreadsIoClient()->page($user->getThreadIoId(), $visit->getThreadsIoTitle(), $visit->getThreadsIoProperties(), $datetime);
        return $response->isSuccess();
    }

    /**
     * @param User $user
     * @param \DateTimeImmutable $datetime
     * @return bool
     */
    public function remove(UserThreadableInterface $user, \DateTimeImmutable $datetime = null) {

        if($datetime === null) {
            $datetime = new \DateTimeImmutable();
        }

        $response = $this->getThreadsIoClient()->remove($user->getThreadIoId(), $datetime);
        return $response->isSuccess();
    }

    /**
     * Getter for $threadsIoClient
     * @return ThreadsIoClient
     */
    public function getThreadsIoClient()
    {
        return $this->threadsIoClient;
    }

    /**
     * Setter for $threadsIoClient
     * @param ThreadsIoClient $threadsIoClient
     */
    public function setThreadsIoClient($threadsIoClient)
    {
        $this->threadsIoClient = $threadsIoClient;
    }
}