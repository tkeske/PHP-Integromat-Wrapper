<?php

namespace Integromat\Traits;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

trait RequestTrait {

    protected $headers;

    public function __construct() {
        parent::__construct();

        $this->headers = ['Authorization' => 'Token ' . $this->getAPIKey() ,
                            'x-imt-apps-sdk-version' => $this->getSDKVersion() ];
    }

    public function appendHeaders(array $headers) {
        $this->headers = array_merge($this->headers, $headers);
    }

    public function setContentTypeHeader(string $contentType) {

        $ret = ['Content-Type' => $contentType ];
        $this->appendHeaders($ret);
    }

    public function sendRequest($type, $url, $contentType, $data) {

        if ($type == "POST")

            $this->setContentTypeHeader($contentType);


        $request = new Request($type, 'https://api.integromat.com/v1' . $url, $this->headers, json_encode($data));

        $client = new Client();
        $promise = $client->send($request);

        $response = $promise->getBody()->getContents();

        return $response;
    }
}