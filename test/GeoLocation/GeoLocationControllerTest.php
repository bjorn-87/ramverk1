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
        $this->controller->setDi($di);
        $this->controller->initialize("http://www.student.bth.se/~bjos19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/testapi", "");
    }

    /**
     * Test the route "indexAction" with valid IP address.
     */
    public function testIndexAction()
    {
        $this->di->request->setGet("ip", "2.2.2.2");
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
