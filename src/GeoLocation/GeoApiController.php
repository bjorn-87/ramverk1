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

    protected $geo;
    private $option;
    private $url;
    private $validateIp;

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
        $this->geo = $this->di->get("geolocation");
        $this->validateIp = new ValidateIp();
        $this->url = "http://api.ipstack.com/";
        $this->option = "?access_key=";
    }

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
        $mapUrl = "https://www.openstreetmap.org/search?query=";
        $valid = $this->validateIp->validate($ipAdr);

        if ($valid) {
            $location = $this->geo->getLocation($ipAdr, $this->url, $this->option);
            $type = $this->validateIp->getIpType($ipAdr);
            $host = $this->validateIp->getHostName($ipAdr);
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
