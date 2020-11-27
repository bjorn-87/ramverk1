<?php

namespace Bjos\Weather;

use Bjos\Weather\WeatherMock;
use Bjos\GeoLocation\GeoLocation;
use Bjos\Validate\validateIp;
use Bjos\Curl\CurlMock;

/**
 * A mock class.
 */
class WeatherControllerMock extends WeatherController
{
    public function initialize() : void
    {
        parent::initialize();
        $this->ipStack = "http://www.student.bth.se/~bjos19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/testapi";
        $this->option = "";
        $this->geo = new GeoLocation();
        $this->validate = new ValidateIp();
        $curl = new CurlMock();
        $this->weather = new WeatherMock($curl);
    }
}
