<?php

namespace Bjos\Weather;

use Bjos\Curl\Curl;

/**
 * A class to get weather info from an api.
 */
class Weather
{
    private $url = "https://api.openweathermap.org/data/2.5/onecall";
    private $filePath = "/config/api_owm.php";
    private $api;
    private $curl = null;

    /**
     * Constructor for the class
     *
     * @param object $curl curl object
     * @return void
     */
    public function __construct(object $curl)
    {
        $apiKey = "apiKey";
        $file = ANAX_INSTALL_PATH . $this->filePath;
        $owm = file_exists($file) ? require $file : null;
        $this->api = $owm ? $owm[$apiKey] : getenv("API_KEY");
        $this->curl = $curl;
    }

    /**
     * Get upcoming weather from api.
     *
     * @return array
     */
    public function getWeather(string $lat = null, string $lon = null)
    {
        $api = $this->api;
        $exclude = "exclude=minutely,hourly,current";
        $url = $this->url . "?lat={$lat}&lon={$lon}&units=metric&lang=sv&{$exclude}&appid={$api}";

        $forecast = $this->curl->curlApi($url);
        $forecast = $this->convertTime($forecast);
        return $forecast;
    }

    /**
     * Get weather history from 5 days ago.
     *
     * @return array
     */
    public function getHistory(string $lat = null, string $lon = null)
    {
        $urls = [];
        $units = "units=metric";
        $lang = "lang=sv";
        $appid = "appid=" . $this->api;

        for ($i=1; $i < 6; $i++) {
            $date = date(strtotime("-{$i} days"));
            $urls[] = $this->url . "/timemachine?lat={$lat}&lon={$lon}&dt={$date}&{$units}&{$lang}&{$appid}";
        }

        $forecast = $this->curl->multiCurlApi($urls);
        $forecast = $this->convertTime($forecast, "current");
        return $forecast;
    }

    /**
     * Converts the time from milliseconds to date d M Y.
     *
     * @return array
     */
    public function convertTime(array $weather, string $option = "daily")
    {
        $count = count($weather);

        if ($option === "daily") {
            if (array_key_exists($option, $weather)) {
                $i = 0;
                foreach ($weather[$option] as $key => $value) {
                    $weather[$option][$i]["dt"] = date('d M Y', $weather[$option][$i]["dt"]);
                    $i++;
                }
            }
        } elseif ($option === "current") {
            for ($i=0; $i < $count; $i++) {
                if (array_key_exists($i, $weather) && array_key_exists($option, $weather[$i])) {
                    $weather[$i][$option]["dt"] = date('d M Y', $weather[$i][$option]["dt"]);
                }
            }
        }
        return $weather;
    }
}
