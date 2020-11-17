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
class GeoLocationController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * This is the index method action, it handles:
     * IP validation and localization of the queryparameter ip.
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Geolocation";
        $page = $this->di->get("page");
        $ipAdr = $this->di->request->getGet("ip");

        $host = null;
        $type = null;
        $location = null;
        $mapLink = null;

        $geo = new GeoLocation("/config/api_ipstack.php");
        $validateIp = new ValidateIp;
        $url = "http://api.ipstack.com/";
        $mapUrl = "https://www.openstreetmap.org/search?query=";

        $valid = $validateIp->validate($ipAdr);

        if ($valid) {
            $type = $validateIp->getIpType($ipAdr);
            $host = $validateIp->getHostName($ipAdr);
            $location = $geo->getLocation($ipAdr, $url, "?access_key=");
            $mapLink = $mapUrl . $location['latitude'] . "," . $location['longitude'];
        }

        $userIp = $geo->getUserIp();

        $data = [
            "valid" => $valid,
            "ip" => $ipAdr,
            "type" => $type,
            "host" => $host,
            "userIp" => $userIp,
            "location" => $location,
            "mapLink" => $mapLink
        ];

        $page->add("geolocation/index", $data);

        $page->add("geolocation/geoapi", [
            "userIp" => $userIp
        ]);

        return $page->render([
            "title" => $title
        ]);
    }
}
