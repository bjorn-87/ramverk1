<?php

namespace Bjos\Weather;

use Bjos\Weather\WeatherMock;
use Bjos\GeoLocation\GeoLocation;
use Bjos\Validate\ValidateIp;
use Bjos\Curl\CurlMock;
use Bjos\Curl\CurlMockGeo;

/**
 * A mock class.
 */
class WeatherControllerMock extends WeatherController
{
    public function initialize() : void
    {
        parent::initialize();
        $this->ipStack = "jjjjj";
        $this->option = "jjjjj";
        $curl = new CurlMock();
        $curlGeo = new CurlMockGeo();
        $this->geo = new GeoLocation($curlGeo);
        $this->validate = new ValidateIp();
        $this->weather = new WeatherMock($curl);
    }
}
