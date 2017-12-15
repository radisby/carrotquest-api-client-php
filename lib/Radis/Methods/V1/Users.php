<?php

namespace Radis\Methods\V1;

trait Users {

    public function usersGet($id) {
        return $this->client->makeRequest(
                        "/users/$id", "GET"
        );
    }

}
