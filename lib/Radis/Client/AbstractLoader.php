<?php

namespace Radis\Client;

use Radis\Http\Client;

abstract class AbstractLoader {

    protected $authToken;
    protected $client;
    protected $url;

    public function __construct($url, $authToken, $version) {

        if ('/' !== $url[strlen($url) - 1]) {
            $url .= '/';
        }

        if (empty($version) || !in_array($version, ['v1'])) {
            throw new \InvalidArgumentException(
            'Version parameter must be not empty and must be equal one of v1'
            );
        }

        $this->authToken = $authToken;

        $url = $url . $version;

        $this->client = new Client($url, ['auth_token' => $authToken]);
    }

}
