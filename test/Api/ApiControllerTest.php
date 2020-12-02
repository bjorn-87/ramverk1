<?php

namespace Bjos\Api;

use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;
use Anax\DI\DIMagic;

/**
 * Test GeoLocationController
 */
class ApiControllerTest extends TestCase
{
    private $controller;

    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        global $di;
        // Init service container $di
        $di = new DIMagic();
        $this->di = $di;
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $this->di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");


        // Create and initiate the controller
        $this->controller = new ApiController();
        $this->controller->setDi($di);
    }

    /**
     * Test the route "indexActionGet" no arguments.
     */
    public function testIndexAction()
    {
        $this->assertInstanceOf("\Bjos\Api\ApiController", $this->controller);
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
