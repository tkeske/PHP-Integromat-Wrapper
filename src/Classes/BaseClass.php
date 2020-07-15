<?php

namespace Integromat\Classes;

class BaseClass {

    protected $apiKey;

    protected $sdkVersion = "5.0.0";

    public function getSDKVersion() {
        return $this->sdkVersion;
    }

    public function getAPIKey() {
        return $this->apiKey;
    }

    public function setAPIKey(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    public function __construct() {
        $env = $this->readEnv();

        $this->setAPIKey($env["INTEGROMAT_API_KEY"]);
    }

    private function readEnv() {

        $_ENV = array();
        $handle = fopen("../.env", "r");

        if($handle) {
            while (($line = fgets($handle)) !== false) {
              if( strpos($line,"=") !== false) {
                $var = explode("=",$line);
                $_ENV[$var[0]] = trim($var[1]);
                }
            }
            fclose($handle);

            return $_ENV;

        } else { die('error opening .env'); }
    }

}
