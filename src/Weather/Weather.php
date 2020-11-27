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
        $forecast = $this->getData($forecast);

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
        $forecast = $this->getData($forecast, "current");
        return $forecast;
    }

    /**
     * Gets the desured data and converts the time from milliseconds to date d M Y.
     *
     * @return array
     */
    public function getData(array $weather, string $option = "daily")
    {
        $count = count($weather);
        $selected = [];

        if ($option === "daily") {
            if (array_key_exists($option, $weather)) {
                $i = 0;
                foreach ($weather[$option] as $key => $value) {
                    $selected[] = [
                            "lat" => $weather["lat"],
                            "lon" => $weather["lon"],
                            "date" => date('d M Y', $weather[$option][$i]["dt"]),
                            "temp_min" => $weather[$option][$i]["temp"]["min"],
                            "temp_max" => $weather[$option][$i]["temp"]["max"],
                            "wind_speed" => $weather[$option][$i]["wind_speed"],
                            "weather" => $weather[$option][$i]["weather"][0]["description"],
                            "icon" => $weather[$option][$i]["weather"][0]["icon"]
                    ];
                    $i++;
                }
            }
        } elseif ($option === "current") {
            for ($i=0; $i < $count; $i++) {
                if (array_key_exists($i, $weather) && array_key_exists($option, $weather[$i])) {
                    $selected[] = [
                            "lat" => $weather[$i]["lat"],
                            "lon" => $weather[$i]["lon"],
                            "date" => date('d M Y', $weather[$i][$option]["dt"]),
                            "temp" => $weather[$i][$option]["temp"],
                            "wind_speed" => $weather[$i][$option]["wind_speed"],
                            "weather" => $weather[$i][$option]["weather"][0]["description"],
                            "icon" => $weather[$i][$option]["weather"][0]["icon"]
                    ];
                }
            }
        }
        return $selected;
    }
}
