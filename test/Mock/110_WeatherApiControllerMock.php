<?php

namespace Bjos\Weather;

use Bjos\Weather\WeatherMock;
use Bjos\GeoLocation\GeoLocation;
use Bjos\Validate\ValidateIp;
use Bjos\Curl\CurlMockGeo;
use Bjos\Curl\CurlMock;

/**
 * A mock class.
 */
class WeatherApiControllerMock extends WeatherApiController
{
    public function initialize() : void
    {
        parent::initialize();
        $this->ipStack = "www.qwert";
        $this->option = "jjjjj";
        $curl = new CurlMock();
        $curlGeo = new CurlMockGeo();
        $this->geo = new GeoLocation($curlGeo);
        $this->validate = new ValidateIp();
        $this->weather = new WeatherMock($curl);
    }
}
