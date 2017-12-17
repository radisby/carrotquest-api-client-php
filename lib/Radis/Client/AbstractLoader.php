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

    /**
     * Check ID parameter
     *
     * @param string $by identify by
     *
     * @throws \InvalidArgumentException
     *
     * @return bool
     */
    protected function checkIdParameter($by) {
        $allowedForBy = [
            'by_user_id',
            'id'
        ];

        if (!in_array($by, $allowedForBy, false)) {
            throw new \InvalidArgumentException(
            sprintf(
                    'Value "%s" for "by" param is not valid. Allowed values are %s.', $by, implode(', ', $allowedForBy)
            )
            );
        }

        return true;
    }

}
