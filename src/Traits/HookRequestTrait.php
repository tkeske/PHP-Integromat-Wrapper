<?php 

namespace Integromat\Traits;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

trait HookRequestTrait {

    public function sendWebHookRequest($hookUrl, $data) {

        $request = new Request('POST', $hookUrl , [], $data);

        $client = new Client();

        $promise = $client->send($request);

        $response = $promise->getBody()->getContents();

        return $response;
    }

}