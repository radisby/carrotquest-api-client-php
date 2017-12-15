<?php

namespace Radis\Client;

use Radis\Http\Client;

abstract class AbstractLoader {

    protected $authToken;
    protected $client;
    protected $url;

    public function __construct($url, $authToken) {

        $this->url = $authToken;
        $this->authToken = $authToken;
        $this->client = new Client($url, ['auth_token' => $authToken]);
    }

}
