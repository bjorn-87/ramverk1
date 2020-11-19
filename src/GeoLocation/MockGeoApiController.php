<?php

namespace Bjos\GeoLocation;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use Bjos\Validate\ValidateIp;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * Controller to "Mock the API"
 *
 */
class MockGeoApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * This is the index method action, it handles:
     * IP validation and localization of the queryparameter ip.
     *
     */
    public function indexActionGet()
    {
        $json = [
            "continent_name" => "Asia",
            "country_name" => "Thailand",
            "region_name" => "Nakhon Ratchasima",
            "city" => "Nakhon Ratchasima",
            "zip" => "30000",
            "latitude" => 14.970279693603516,
            "longitude" => 102.10360717773438,
            "location" => [
                "country_flag" => "http://assets.ipstack.com/flags/th.svg"
            ]
        ];
        return json_encode($json);
    }
}
