<?php

namespace Radis\Client;

use Radis\Methods\V1;

class ApiVersion1 extends AbstractLoader {

    /**
     * Init version based client
     *
     * @param string $url     api url
     * @param string $apiKey  api key
     * @param string $version api version
     * @param string $site    site code
     *
     */
    public function __construct($authToken) {
        parent::__construct($authToken);
    }

    use V1\Users;
}
