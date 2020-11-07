<?php

namespace Bjos\Validate;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ValidateIpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : object
    {
        $title = "Validate IP";
        $valid = "";
        $type = "";
        $host = "";
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

        $page->add("validate-ip/index", [
            "valid" => $valid,
            "ip" => $ipAdr,
            "type" => $type,
            "host" => $host
        ]);

        return $page->render([
            "title" => $title
        ]);
    }
}
