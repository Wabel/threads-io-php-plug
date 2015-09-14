<?php
/**
 * Created by PhpStorm.
 * User: BadaBing
 * Date: 14/09/2015
 * Time: 15:05
 */

namespace Wabel\ThreadsIo\Interfaces;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Implements the ability for user entity to be tracked by Threads.io
 * @see https://docs.threads.io/docs/identify-a-user
 *
 * Interface ThreadableInterface
 * @package \ThreadsIo
 */
interface ThreadableInterface {
    /**
     * This getter returns the ID to be used in Threads.io to identify a user.
     * @return string       - The output should be a string as requested by the API
     */
    public function getThreadIoId();

    /**
     * This getter returns the ID to be used in Threads.io to identify a user.
     * @return JsonResponse - A JsonResponse object containing the information to be logged in Threads.io
     * @see https://docs.threads.io/docs/identify-a-user for json traits examples.
     */
    public function getThreadIoTraits();
}