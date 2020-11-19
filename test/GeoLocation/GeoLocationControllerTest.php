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
        $this->controller = new GeoLocationController;
        $this->controller->initialize("http://www.student.bth.se/~bjos19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/testapi", "");
        $this->controller->setDi($di);
    }

    /**
     * Test the route "indexAction" with valid IP address.
     */
    public function testIndexAction()
    {
        $request = $this->di->get("request");
        $request->setGet("ip", "2.2.2.2");
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
