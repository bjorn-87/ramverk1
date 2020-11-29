<?php

namespace Bjos\Geolocation;

/**
 * A mock class.
 */
class GeoLocationMock extends GeoLocation
{
    public function getLocation(
        string $ipAdr = null,
        string $url = null,
        string $option = null
    ) {
        $ipAdr = null;
        $url = null;
        $option = null;
        $json = null;
        
        if ($url) {
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
        }
        return $json;
    }
}
