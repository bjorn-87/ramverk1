<?php

namespace Bjos\GeoLocation;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use Bjos\Validate\ValidateIp;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * Controller to get location of an IP address.
 *
 */
class GeoApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * Shows basic instruction how to use api.
     *
     * @return array
     */
    public function indexActionGet() : array
    {
        $json = [
            "data" => [
                "message" => "Use POST with IP-address in body to validate and locate ip",
                "example" => "POST /geoapi/ {'ip': '8.8.8.8'}",
            ],
        ];
        return [$json];
    }

    /**
     * This is the index method action, it handles:
     * IP validation and localization of the queryparameter ip.
     *
     * @return object
     */
    public function indexActionPost() : array
    {
        $ipAdr = $this->di->request->getPost("ip");

        $host = null;
        $type = null;
        $location = null;

        $geo = new GeoLocation("/config/api_ipstack.php");
        $validateIp = new ValidateIp;
        $url = "http://api.ipstack.com/";
        $mapUrl = "https://www.openstreetmap.org/search?query=";

        $valid = $validateIp->validate($ipAdr);

        if ($valid) {
            $location = $geo->getLocation($ipAdr, $url, "?access_key=");
            $type = $validateIp->getIpType($ipAdr);
            $host = $validateIp->getHostName($ipAdr);
            $mapLink = $mapUrl . $location['latitude'] . "," . $location['longitude'];
            $json = [
                "ip" => $ipAdr,
                "valid" => $valid,
                "type" => $type,
                "host" => $host,
                "continent_name" => $location["continent_name"],
                "country" => $location["country_name"],
                "city" => $location["city"],
                "zip" => $location["zip"],
                "latitude" => $location["latitude"],
                "longitude" => $location["longitude"],
                "country_flag" => $location["location"]["country_flag"],
                "map_link" => $location['latitude'] !== null ? $mapLink : null
            ];
        } else if (isset($ipAdr) && !$valid) {
            http_response_code(400);
            $json = [
                "error" => [
                    "status" => http_response_code(),
                    "error" => "Bad Request",
                    "ip" => $ipAdr,
                    "message" => "Not a valid IP-Address"
                ]
            ];
        } else {
            http_response_code(400);
            $json = [
                "error" => [
                    "status" => http_response_code(),
                    "error" => "Bad Request",
                    "message" => "ip missing in body",
                ]
            ];
        }
        return [$json];
    }
}
