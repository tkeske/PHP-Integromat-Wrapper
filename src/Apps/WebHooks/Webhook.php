<?php

namespace Apps\Webhooks;

use Classes\BaseClass;
use Traits\RequestTrait;


class Webhook extends BaseClass {

    use RequestTrait;

    public function createNewWebHook($label, $type = "web") {

        $data = ['label' => $label, 'type' => $type];

        $response = $this->sendRequest('POST', '/app/{{app}}/webhook', 'application/json', $data);

        var_dump($response);

        return $response;
    }

}