<?php

namespace App\Http\Controllers\Support;

use Zttp\Zttp;

/**
 * Trait ConsumesInternalApi
 *
 * Allows you to consume your own API
 *
 * @package App\Http\Controllers\Support
 */
trait ConsumesInternalApi
{
    /**
     * Send GET request to an internal API endpoint
     *
     * @param string $routeName
     * @param array $payload
     *
     * @return array
     */
    public function getInternal(string $routeName, array $payload = []) : array
    {
        return Zttp::get(route($routeName), $payload)->json();
    }

    /**
     * Send POST request to an internal API endpoint
     *
     * @param string $routeName
     * @param array $payload
     *
     * @return array
     */
    public function postInternal(string $routeName, array $payload = []) : array
    {
        return Zttp::post(route($routeName), $payload)->json();
    }
}
