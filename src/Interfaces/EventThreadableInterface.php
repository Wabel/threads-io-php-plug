<?php

namespace Wabel\ThreadsIo\Interfaces;

/**
 * Implements the ability for an entity to be referenced as an Event by Threads.io
 * @see https://docs.threads.io/docs/track-an-event
 *
 * If no entity in your app would fit this interface, use the Entities\Event class
 *
 * Interface EventThreadableInterface
 * @package Wabel\ThreadsIo\Interfaces
 */
interface EventThreadableInterface extends AbstractThreadableInterface {
    /**
     * This getter returns the ID to be used in Threads.io to identify an Event.
     * @return string               - The output should be a string as requested by the API
     */
    public function getThreadsIoId();

    /**
     * This getter returns the ID to be used in Threads.io to identify a user.
     * @return \DateTimeImmutable   - An array  containing the DateTime of when the Event occurred
     */
    public function getThreadsIoDateTime();

    /**
     * This getter returns an array object containing the information to be logged in Threads.io.
     * @return array
     * @see https://docs.threads.io/docs/track-an-event for json properties examples.
     */
    public function getThreadsIoProperties();
}