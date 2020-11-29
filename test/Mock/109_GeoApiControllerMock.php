<?php

namespace Bjos\GeoLocation;

use Bjos\GeoLocation\GeoLocation;
use Bjos\Curl\CurlMockGeo;

/**
 * A mock class.
 */
class GeoApiControllerMock extends GeoApiController
{
    public function initialize() : void
    {
        parent::initialize();
        $curl = new CurlMockGeo();
        $this->geo = new GeoLocation($curl);
    }
}
