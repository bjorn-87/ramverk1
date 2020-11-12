<?php

namespace Bjos\Validate;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * Validates IP address and return a json response.
 */
class IpJsonController implements ContainerInjectableInterface
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
                "message" => "Use POST with IP-address in body to validate",
                "example" => "POST /ip-json/ {'ip': '8.8.8.8'}",
            ],
        ];
        return [$json];
    }

    /**
     * Validates IP address in post method.
     *
     * @return array
     */
    public function indexActionPost() : array
    {
        $valid = null;
        $type = null;
        $host = null;
        // $page = $this->di->get("page");
        $ipAdr = $this->di->request->getPost("ip");

        if ($ipAdr) {
            if (filter_var($ipAdr, FILTER_VALIDATE_IP)) {
                $valid = true;
                $host = gethostbyaddr($ipAdr);
            } else {
                $valid = false;
            }

            if ($valid) {
                if (filter_var($ipAdr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                    $type = "IPV4";
                } elseif (filter_var($ipAdr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                    $type = "IPV6";
                }
            }
            $json = [
                "ip" => $ipAdr,
                "valid" => $valid,
                "type" => $type,
                "host" => $host
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
