<?php

namespace Traits;

require 'vendor/autoload.php';

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

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

        $client = new Client([
            'base_uri' => 'https://api.integromat.com/v1',

        ]);

        if ($type == "POST")

            $this->setContentTypeHeader($contentType);
            

        $request = new Request($type, $url, $this->headers, $data);
    
        $promise = $client->sendAsync($request);

        $response = null;

        $promise->then(
            function (ResponseInterface $res) use ($response) {
                $response = $res->getBody()->getContents();
            },
            function (RequestException $e) {
                var_dump($e);
                die();
            }
        );

        return $response;
    }
}