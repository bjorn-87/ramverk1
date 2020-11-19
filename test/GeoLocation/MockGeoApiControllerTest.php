<?php

namespace Bjos\GeoLocation;

use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;
use Anax\DI\DIMagic;

/**
 * Test GeoLocationController
 */
class MockGeoApiControllerTest extends TestCase
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
        $this->controller = new MockGeoApiController();
        $this->controller->setDi($di);
    }

    /**
     * Test the route "indexActionGet" no arguments.
     */
    public function testIndexActionGet()
    {
        $this->assertInstanceOf("\Bjos\GeoLocation\MockGeoApiController", $this->controller);
        $res = $this->controller->indexActionGet();
        $result = json_decode($res);
        $this->assertInstanceOf('stdClass', $result);
    }
}
