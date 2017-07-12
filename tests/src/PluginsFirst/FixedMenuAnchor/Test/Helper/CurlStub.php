<?php

namespace PluginsFirst\FixedMenuAnchor\Test\Helper;

use Curl\Curl;

/**
 * Provides a stub for Curl class to avoid making real HTTP requests in unit tests.
 *
 * Usage inspired by http://omni-spot.blogspot.de/2010/09/unit-testing-curl-code-in-php.html
 */
class CurlStub extends Curl
{
    /**
     * @var string
     */
    protected $cookieJar;

    /**
     * Simulate file download.
     *
     * @param string $url
     * @param mixed $mixed_filename
     */
    public function download($url, $mixed_filename)
    {
        return ! $this->error;
    }

    /**
     * Simulates a GET request.
     *
     * @param string $url
     * @param array $parameter optional
     */
    public function get($url, $parameter = array())
    {
    }

    /**
     * Get cookie jar set before.
     *
     * @return string
     */
    public function getCookieJar()
    {
        return $this->cookieJar;
    }

    /**
     * Simulates a POST request.
     *
     * @param string $url
     * @param array $parameter optional
     */
    public function post($url, $parameter = array())
    {
    }

    /**
     * Set cookie jar.
     *
     * @param string $cookieJarPath
     */
    public function setCookieJar($cookieJarPath)
    {
        $this->cookieJar = $cookieJarPath;
    }

    /**
     * Pre-set a response of a curl call.
     *
     * @param string $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * Pre-set a response of a curl call.
     *
     * @param string $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}
