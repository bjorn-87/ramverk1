<?php

namespace Bjos\Validate;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * Controller to validate IP address.
 *
 */
class ValidateIpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * This is the index method action, it handles:
     * IP validation of the queryparameter ip.
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Validate IP";
        $valid = null;
        $type = null;
        $host = null;
        $page = $this->di->get("page");
        $ipAdr = $this->di->request->getGet("ip");

        if ($ipAdr) {
            if (filter_var($ipAdr, FILTER_VALIDATE_IP)) {
                $valid = "True";
                $host = gethostbyaddr($ipAdr);
            } else {
                $valid = "False";
            }

            if ($valid === "True") {
                if (filter_var($ipAdr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                    $type = "IPV4";
                } elseif (filter_var($ipAdr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                    $type = "IPV6";
                }
            }
        }

        $page->add("bjos/validate-ip/index", [
            "valid" => $valid,
            "ip" => $ipAdr,
            "type" => $type,
            "host" => $host
        ]);

        $page->add("bjos/validate-ip/ip-json");

        return $page->render([
            "title" => $title
        ]);
    }
}
