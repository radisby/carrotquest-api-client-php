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
    public function usersEventCreate($id, $event, array $params, $by_user_id = false) {

        if (!$id) {
            throw new \InvalidArgumentException(
            'Parameter `id` must be set'
            );
        }

        if (!$event) {
            throw new \InvalidArgumentException(
            'Parameter `event` must be set'
            );
        }

        $data = [
            'event' => $event,
            'by_user_id' => $by_user_id,
        ];

        if (!empty($params)) {
            $data['params'] = json_encode($params);
        }

        return $this->client->makeRequest(
                        sprintf('/users/%s/events', $id), "POST", $data
        );
    }

}
