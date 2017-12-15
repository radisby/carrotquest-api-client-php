<?php

namespace Radis\Http;

class Client {

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    private $auth_token = null;
    protected $url;

    public function __construct($url) {
        $this->url = $url;
    }

    public function makeRequest(
    $path, $method, array $parameters = []
    ) {
        $allowedMethods = [self::METHOD_GET, self::METHOD_POST];
        if (!in_array($method, $allowedMethods, false)) {
            throw new \InvalidArgumentException(
            sprintf(
                    'Method "%s" is not valid. Allowed methods are %s', $method, implode(', ', $allowedMethods)
            )
            );
        }
        $parameters = array_merge($this->defaultParameters, $parameters);
        $url = $fullPath ? $path : $this->url . $path;
        if (self::METHOD_GET === $method && count($parameters)) {
            $url .= '?' . http_build_query($parameters, '', '&');
        }
        $curlHandler = curl_init();
        curl_setopt($curlHandler, CURLOPT_URL, $url);
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandler, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curlHandler, CURLOPT_FAILONERROR, false);
        curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curlHandler, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curlHandler, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandler, CURLOPT_CONNECTTIMEOUT, 30);
        if (self::METHOD_POST === $method) {
            curl_setopt($curlHandler, CURLOPT_POST, true);
            curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $parameters);
        }
        $responseBody = curl_exec($curlHandler);
        $statusCode = curl_getinfo($curlHandler, CURLINFO_HTTP_CODE);
        $errno = curl_errno($curlHandler);
        $error = curl_error($curlHandler);
        curl_close($curlHandler);
        if ($errno) {
            throw new CurlException($error, $errno);
        }
        return new ApiResponse($statusCode, $responseBody);
    }

}
