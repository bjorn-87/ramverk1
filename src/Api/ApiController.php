<?php

namespace Bjos\Api;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A test controller to show off using a model.
 */
class ApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Page to show all Apis.
     */
    public function indexAction()
    {
        $page = $this->di->get("page");
        $geo = $this->di->get("geolocation");
        $userIp = $geo->getUserIp();
        $page->add("api/allapi", [
            "userIp" => $userIp
        ]);
        return $page->render([
            "title" => "All Api",
        ]);
    }
}
