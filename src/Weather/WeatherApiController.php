<?php

namespace Bjos\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * Controller to get location of an IP address.
 *
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 */
class WeatherApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $validate;
    protected $geo;
    protected $ipStack;
    protected $option;
    protected $weather;


    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->ipStack = "http://api.ipstack.com/";
        $this->option = "?access_key=";
        $this->geo = $this->di->get("geolocation");
        $this->validate = $this->di->get("validate");
        $this->weather = $this->di->get("weather");
    }

    /**
     * Shows basic instruction how to use api.
     *
     * @return array
     */
    public function indexActionGet() : array
    {
        $json = [
            "data" => [
                "message" => "Use POST with IP-address or coordinates separated by comma (',') in body to get weather",
                "example ip" => "POST /weatherapi/ {'search': '8.8.8.8'}",
                "example Long,Lat" => "POST /weatherapi/ {'search': '67,20'}",
            ],
        ];
        return [$json];
    }

    /**
     * Get wheter info by ip-address or coordinates.
     *
     * @return array
     */
    public function indexActionPost() : array
    {
        $mapUrl = "https://www.openstreetmap.org/search?query=";
        $lat = null;
        $long = null;
        $location= null;
        $type = ["history", "forecast"];
        $forecast = null;
        $city = null;
        $country = null;
        $search = $this->di->request->getPost("search");
        $weather = $this->di->request->getPost("weather");

        if (!$search && !$weather) {
            http_response_code(400);
            $json = [
                "error" => [
                    "status" => http_response_code(),
                    "error" => "Bad Request",
                    "search" => $search,
                    "weather" => $weather,
                    "message" => "Argument search and weather missing in body"
                ]
            ];
            return [$json];
        } elseif (!in_array($weather, $type)) {
            http_response_code(400);
            $json = [
                "error" => [
                    "status" => http_response_code(),
                    "error" => "Bad Request",
                    "weather" => $weather,
                    "message" => "Not valid input 'weather': '{$weather}', use 'history' or 'forecast'"
                ]
            ];
            return [$json];
        } elseif ($search) {
            $valid = $this->validate->validate($search);
            if ($valid) {
                $location = $this->geo->getLocation($search, $this->ipStack, $this->option);
                $lat = $location["latitude"];
                $long = $location["longitude"];
                $city = $location["city"];
                $country = $location["country_name"];
            } else {
                $location = $this->weather->getLatLong($search);
                $lat = $location["latitude"];
                $long = $location["longitude"];
            }

            if ($weather === "history") {
                $forecast = $this->weather->getHistory($lat, $long);
            } elseif ($weather === "forecast") {
                $forecast = $this->weather->getWeather($lat, $long);
            }

            $mapLink = $mapUrl . $location['latitude'] . "," . $location['longitude'];
            $json = [
                "search" => $search,
                "ip_address" => $valid,
                "weather_type" => $weather,
                "location" => [
                    "latitude" => $location["latitude"],
                    "longitude" => $location["longitude"],
                    "city" => $city,
                    "country_name" => $country,
                ],
                "forecast" => $forecast,
                "map_link" => $location['latitude'] !== null ? $mapLink : null
            ];
        } else {
            http_response_code(400);
            $json = [
                "error" => [
                    "status" => http_response_code(),
                    "error" => "Bad Request",
                    "search" => $search,
                    "message" => "'search' missing in body"
                ]
            ];
            return [$json];
        }
        if (empty($lat) || empty($forecast)) {
            http_response_code(404);
            $json = [
                "error" => [
                    "status" => http_response_code(),
                    "error" => "Not found",
                    "search" => $search,
                    "weather" => $weather,
                    "message" => "Location not found"
                ]
            ];
        }
        return [$json];
    }
}
