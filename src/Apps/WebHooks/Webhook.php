<?php

namespace Integromat\Apps\Webhooks;

use Integromat\Classes\BaseClass;
use Integromat\Traits\RequestTrait;


class Webhook extends BaseClass {

    use RequestTrait;

    public function createNewWebHook($appName, $label, $type = "web") {

        $data = ['label' => $label, 'type' => $type];

        $response = $this->sendRequest('POST', '/app/' .$appName . '/webhook', 'application/json', $data);

        return $response;
    }

}
