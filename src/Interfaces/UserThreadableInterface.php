<?php

namespace Wabel\ThreadsIo\Interfaces;

/**
 * Implements the ability for user entity to be tracked by Threads.io
 * @see https://docs.threads.io/docs/identify-a-user
 *
 * Interface UserThreadableInterface
 * @package Wabel\ThreadsIo\Interfaces
 */
interface UserThreadableInterface {
    /**
     * This getter returns the ID to be used in Threads.io to identify a user.
     * @return string       - The output should be a string as requested by the API
     */
    public function getThreadIoId();

    /**
     * This getter returns an array containing the information to be logged about the User in Threads.io
     * @return array
     * @see https://docs.threads.io/docs/identify-a-user for json traits examples.
     */
    public function getThreadIoTraits();
}