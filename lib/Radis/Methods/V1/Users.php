<?php

namespace Radis\Methods\V1;

trait Users {

    /**
     * Get user by id
     * 
     * @param type $id
     * @return type
     */
    public function usersGet($id) {
        if (!$id) {
            throw new \InvalidArgumentException(
            'Parameter `id` must be set'
            );
        }

        return $this->client->makeRequest(
                        "/users/$id", "GET"
        );
    }

    /**
     * Create user event
     * 
     * @param array $event
     * @param type $by
     */
    public function usersEventCreate($event, array $params, $by = 'id') {

        if (!$event) {
            throw new \InvalidArgumentException(
            'Parameter `event` must be set'
            );
        }

        if (!count($params)) {
            throw new \InvalidArgumentException(
            'Parameter `params` must contains a data'
            );
        }

        $this->checkIdParameter($by);

        return $this->client->makeRequest(
                        sprintf('/users/%s/events', $params[$by]), "POST", ['params' => json_encode($params), 'by' => $by]
        );
    }

}
