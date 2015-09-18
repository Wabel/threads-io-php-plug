<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 15:05
 */

namespace Wabel\ThreadsIo\Interfaces;

/**
 * Implements the ability for user entity to be tracked by Threads.io
 * @see https://docs.threads.io/docs/identify-a-user
 *
 * Interface UserThreadableInterface
 * @package \ThreadsIo
 */
interface UserThreadableInterface {
    /**
     * This getter returns the ID to be used in Threads.io to identify a user.
     * @return string       - The output should be a string as requested by the API
     */
    public function getThreadIoId();

    /**
     * This getter returns the ID to be used in Threads.io to identify a user.
     * @return array - An array object containing the information to be logged in Threads.io
     * @see https://docs.threads.io/docs/identify-a-user for json traits examples.
     */
    public function getThreadIoTraits();
}