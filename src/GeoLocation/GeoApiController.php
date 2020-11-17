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

        $valid = $validateIp->validate($ipAdr);

        if ($valid) {
            $location = $geo->getLocation($ipAdr, $url, "?access_key=");
            $type = $validateIp->getIpType($ipAdr);
            $host = $validateIp->getHostName($ipAdr);
            $json = [
                "ip" => $ipAdr,
                "valid" => $valid,
                "type" => $type,
                "host" => $host,
                "country" => $location["country_name"],
                "city" => $location["city"],
                "longitude" => $location["longitude"],
                "latitude" => $location["latitude"]
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
