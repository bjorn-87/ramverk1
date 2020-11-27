<?php

namespace Bjos\GeoLocation;

use Bjos\Curl\Curl;

class GeoLocation
{
    private $file;
    private $api;
    private $filePath;
    private $apiKey;
    private $curl;

    /**
     *
     * @return void
     */
    public function __construct(
        string $filePath = "/config/api_ipstack.php",
        string $apiKey = "apiKey"
    ) {
        $this->filePath = $filePath;
        $this->apiKey = $apiKey;
        $this->file = ANAX_INSTALL_PATH . $this->filePath;
        $ipStack = file_exists($this->file) ? require $this->file : null;
        $this->api = $ipStack ? $ipStack[$this->apiKey] : getenv("API_KEY");
        $this->curl = new Curl();
    }

    /**
     * Method to get user ip.
     *
     * @return string|void $ipAdr
     */
    public function getUserIp()
    {
        $ipAdr = null;

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAdr = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAdr = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $ipAdr = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipAdr = "X.X.X.X";
        }
        return $ipAdr;
    }

    /**
     * Method to get location of a ip address.
     *
     * @return array|void $res
     */
    public function getLocation(
        string $ipAdr = null,
        string $url = null,
        string $option = null
    ) {
        $res = null;

        if ($url) {
            $url = $option ? $url . $ipAdr . $option . $this->api : $url;

            $res = $this->curl->curlApi($url);
        }

        return $res;
    }
}
