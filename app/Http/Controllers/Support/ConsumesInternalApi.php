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
     * Last API status code
     *
     * @var int
     */
    private $lastApiStatus;

    /**
     * @return int
     */
    public function getLastApiStatus(): int
    {
        return $this->lastApiStatus;
    }

    /**
     * @param int $lastApiStatus
     */
    public function setLastApiStatus(int $lastApiStatus)
    {
        $this->lastApiStatus = $lastApiStatus;
    }

    /**
     * Send GET request to an internal API endpoint
     *
     * @param string $routeName
     * @param array $payload
     * @param array $routeParams
     *
     * @return null|array
     */
    public function apiGet(string $routeName, array $payload = [], array $routeParams = [])
    {
        $response = Zttp::get(route($routeName, $routeParams), $payload);
        $this->setLastApiStatus($response->status());

        return $response->json();
    }

    /**
     * Send POST request to an internal API endpoint
     *
     * @param string $routeName
     * @param array $payload
     * @param array $routeParams
     *
     * @return null|array
     */
    public function apiPost(string $routeName, array $payload = [], array $routeParams = [])
    {
        $response = Zttp::post(route($routeName, $routeParams), $payload);
        $this->setLastApiStatus($response->status());

        return $response->json();
    }

    /**
     * Send DELETE request to an internal API endpoint
     *
     * @param string $routeName
     * @param array $payload
     * @param array $routeParams
     *
     * @return null|array
     */
    public function apiDelete(string $routeName, array $payload = [], array $routeParams = [])
    {
        $payload = array_merge($payload, ['_method' => 'DELETE']);
        $response = Zttp::post(route($routeName, $routeParams), $payload);

        $this->setLastApiStatus($response->status());

        return $response->json();
    }

    /**
     * Send PUT request to an internal API endpoint
     *
     * @param string $routeName
     * @param array $payload
     * @param array $routeParams
     *
     * @return null|array
     */
    public function apiPut(string $routeName, array $payload = [], array $routeParams = [])
    {
        $payload = array_merge($payload, ['_method' => 'PUT']);
        $response = Zttp::post(route($routeName, $routeParams), $payload);

        $this->setLastApiStatus($response->status());

        return $response->json();
    }

    /**
     * Send PATCH request to an internal API endpoint
     *
     * @param string $routeName
     * @param array $payload
     * @param array $routeParams
     *
     * @return null|array
     */
    public function apiPatch(string $routeName, array $payload = [], array $routeParams = [])
    {
        $payload = array_merge($payload, ['_method' => 'PATCH']);
        $response = Zttp::post(route($routeName, $routeParams), $payload);

        $this->setLastApiStatus($response->status());

        return $response->json();
    }
}
