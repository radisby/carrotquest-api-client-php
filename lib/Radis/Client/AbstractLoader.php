<?php

namespace Radis\Client;

use Radis\Http\Client;

abstract class AbstractLoader {

    protected $authToken;
    protected $client;

    public function __construct($authToken) {

        $this->authToken = $authToken;
        $this->client = new Client($authToken);
    }

}
