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

    private $geo;
    private $option;
    private $url;

    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize(
        string $url = "http://api.ipstack.com/",
        string $option = "?access_key="
    ) : void {
        // Use to initialise member variables.
        $this->geo = new GeoLocation();
        $this->url = $url;
        $this->option = $option;
    }

    /**
     * This is the index method action, it handles:
     * IP validation and localization of the queryparameter ip.
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "Geolocation";
        $page = $this->di->get("page");
        $ipAdr = $this->di->request->getGet("ip");

        $validateIp = new ValidateIp();

        $host = null;
        $type = null;
        $location = null;
        $valid = $validateIp->validate($ipAdr);

        if ($valid) {
            $location = $this->geo->getLocation($ipAdr, $this->url, $this->option);
            $type = $validateIp->getIpType($ipAdr);
            $host = $validateIp->getHostName($ipAdr);
        }

        $userIp = $this->geo->getUserIp();

        $data = [
            "valid" => $valid,
            "ip" => $ipAdr,
            "type" => $type,
            "host" => $host,
            "userIp" => $userIp,
            "location" => $location
        ];

        $page->add("geolocation/index", $data);

        $page->add("geolocation/geomap", [
            "location" => $location
        ]);

        $page->add("geolocation/geoapi", [
            "userIp" => $userIp
        ]);

        return $page->render([
            "title" => $title
        ]);
    }
}
