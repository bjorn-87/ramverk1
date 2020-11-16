<?php

namespace Bjos\GeoLocation;

class GeoLocation
{
    private $file;
    private $api;
    private $filePath;
    private $apiKey;

    /**
     *
     * @return void
     */
    public function __construct(string $filePath = "test.php", string $apiKey = "apiKey")
    {
        $this->filePath = $filePath;
        $this->file = ANAX_INSTALL_PATH . $this->filePath;
        $this->api = file_exists($this->file) ? require $this->file : getenv("API_KEY");
        $this->apiKey = $apiKey;
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
    public function getLocation(string $ipAdr = null, string $url = null, string $option = null)
    {
        $res = null;

        if (filter_var($ipAdr, FILTER_VALIDATE_IP) && isset($url)) {
            $url = $url . $ipAdr . $option . $this->api[$this->apiKey];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($curl);
            curl_close($curl);
            $res = json_decode($output, true);
        }

        return $res;
    }
}
