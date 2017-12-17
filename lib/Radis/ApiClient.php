<?php

namespace Radis;

use Radis\Client\ApiVersion1;

class ApiClient {

    public $request;
    public $version;

    const V1 = "v1";
    const URL = "https://api.carrotquest.io";

    /**
     * Init version based client
     *
     * @param string $url     api url
     * @param string $apiKey  api key
     * @param string $version api version
     *
     */
    public function __construct($authToken, $version = self::V1) {
        $this->version = $version;
        switch ($version) {
            case self::V1:
                $this->request = new ApiVersion1(self::URL, $authToken, $version);
                break;
        }
    }

    /**
     * Get API version
     *
     * @return string
     */
    public function getVersion() {
        return $this->version;
    }

}
