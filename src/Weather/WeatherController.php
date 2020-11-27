<?php

namespace Bjos\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * Controller to get weather information.
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 */
class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $geo;
    private $validate;
    protected $ipStack;
    protected $option;

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
     * Get wheter info by ip-address or coordinates.
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "Weather";
        $page = $this->di->get("page");
        $lat = null;
        $long = null;
        $location= null;
        $type = null;
        $userIp = $this->geo->getUserIp();

        $ipAdr = $this->di->request->getGet("ip") ? $this->di->request->getGet("ip") : $userIp;

        $coords = explode(",", $ipAdr);
        $coordsLength = count($coords);

        $forecast = $this->di->request->getGet("weather") ? $this->di->request->getGet("weather") : "forecast";

        $valid = $this->validate->validate($ipAdr);

        if ($valid) {
            $location = $this->geo->getLocation($ipAdr, $this->ipStack, $this->option);
            $lat = $location["latitude"];
            $long = $location["longitude"];
        } elseif (is_array($coords) && $coordsLength === 2) {
            if (is_numeric($coords[0]) && is_numeric($coords[1])) {
                $lat = floatval($coords[0]);
                $location["latitude"] = $lat;
                $long = floatval($coords[1]);
                $location["longitude"] = $long;
            }
        }

        if ($forecast === "hist" && $lat && $long) {
            $forecast = $this->weather->getHistory($lat, $long);
            $type = "history";
        } elseif ($forecast === "forecast" && $lat && $long) {
            $forecast = $this->weather->getWeather($lat, $long);
            $forecast = $forecast["daily"];
            $type = "forecast";
        }


        $data = [
            "userIp" => $userIp,
            "valid" => $valid
        ];

        $page->add("weather/index", $data);

        $page->add("geolocation/geomap", [
            "location" => $location
        ]);
        $page->add("weather/table", [
            "type" => $type,
            "forecast" => $forecast,
            "valid" => $valid,
        ]);

        return $page->render([
            "title" => $title
        ]);
    }
}
