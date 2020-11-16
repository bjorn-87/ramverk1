<?php

namespace Bjos\GeoLocation;

use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;
use Anax\DI\DIMagic;

/**
 * Test GeoLocationController
 */
class GeoLocationControllerTest extends TestCase
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
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $this->di = $di;

        // Create and initiate the controller
        $this->controller = new GeoLocationController();
        $this->controller->setDi($di);
    }

    /**
     * Test the route "indexAction" with valid IP address.
     */
    public function testIndexActionWithValidIp()
    {
        $this->di->request->setGet("ip", "1.1.1.1");
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
