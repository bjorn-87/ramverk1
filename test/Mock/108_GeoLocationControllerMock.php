<?php

namespace Bjos\GeoLocation;

use Bjos\GeoLocation\GeoLocation;
use Bjos\Curl\CurlMockGeo;

/**
 * A mock class.
 */
class GeoLocationControllerMock extends GeoLocationController
{
    public function initialize() : void
    {
        parent::initialize();
        $curl = new CurlMockGeo();
        $this->geo = new GeoLocation($curl);
    }
}
