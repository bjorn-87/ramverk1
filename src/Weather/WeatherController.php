<?php

namespace Bjos\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * Controller to get weather information.
 */
class WeatherController implements ContainerInjectableInterface
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

        $ipAdr = $this->di->request->getGet("search") ? $this->di->request->getGet("search") : $userIp;
        $forecast = $this->di->request->getGet("weather") ? $this->di->request->getGet("weather") : "forecast";
        $valid = $this->validate->validate($ipAdr);

        if ($valid) {
            $location = $this->geo->getLocation($ipAdr, $this->ipStack, $this->option);
            $lat = $location["latitude"];
            $long = $location["longitude"];
        } else {
            $location = $this->weather->getLatLong($ipAdr);
            $lat = $location["latitude"];
            $long = $location["longitude"];
        }

        if ($forecast === "hist") {
            $forecast = $this->weather->getHistory($lat, $long);
            if ($forecast) {
                $type = "history";
            }
        } elseif ($forecast === "forecast") {
            $forecast = $this->weather->getWeather($lat, $long);
            if ($forecast) {
                $type = "forecast";
            }
        }

        $data = [
            "userIp" => $userIp,
            "valid" => $valid
        ];

        $page->add("bjos/weather/index", $data);

        $page->add("bjos/geolocation/geomap", [
            "location" => $location
        ]);
        $page->add("bjos/weather/table", [
            "location" => $location,
            "type" => $type,
            "forecast" => $forecast,
            "valid" => $valid,
        ]);

        return $page->render([
            "title" => $title
        ]);
    }
}
