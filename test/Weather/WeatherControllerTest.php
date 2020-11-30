<?php

namespace Bjos\Weather;

use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;
use Anax\DI\DIMagic;

/**
 * Test GeoLocationController
 */
class WeatherControllerTest extends TestCase
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
        $this->controller = new WeatherControllerMock();
        $this->controller->setDi($di);
        $this->controller->initialize();
    }

    /**
     * Test the route "indexAction" with valid ip and forecast
     */
    public function testIndexActionWithIpAndForcast()
    {
        $this->di->request->setGet("search", "2.2.2.2");
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "indexAction" with valid ip and history
     */
    public function testIndexActionWithIpAndHistory()
    {
        $this->di->request->setGet("search", "2.2.2.2");
        $this->di->request->setGet("weather", "hist");
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "indexAction" with Lat and Long forecast.
     */
    public function testIndexActionWithLatLongForcast()
    {
        $this->di->request->setGet("search", "67, 20");
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "indexAction" with lat and long history.
     */
    public function testIndexActionWithLatLongHistory()
    {
        $this->di->request->setGet("search", "67, 20");
        $this->di->request->setGet("weather", "hist");
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "indexAction" with invalid lat and long.
     */
    public function testIndexActionWithLatLongForecastFail()
    {
        $this->di->request->setGet("search", "fdgjdfg, gfjfgj");
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "indexAction" with no argument.
     */
    public function testIndexActionWithNoArgument()
    {
        $res = $this->controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
