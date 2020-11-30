<?php

namespace Bjos\Weather;

use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;
use Anax\DI\DIMagic;

/**
 * Test GeoLocationController
 */
class WeatherApiControllerTest extends TestCase
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
        $this->controller = new WeatherApiControllerMock();
        $this->controller->setDi($di);
        $this->controller->initialize();
    }

    /**
     * Test the route "indexActionGet"
     */
    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();
        // $this->assertInstanceOf(ResponseUtility::class, $res);
        $exp = "POST /weatherapi/ {'search': '8.8.8.8'}";
        $this->assertIsArray($res);
        $this->assertEquals($exp, $res[0]["data"]["example ip"]);
    }

    /**
     * Test the route "indexActionPost" with valid ip and history
     */
    public function testIndexActionPostWithIpAndHistory()
    {
        $this->di->request->setPost("search", "1.1.1.1");
        $this->di->request->setPost("weather", "history");
        $res = $this->controller->indexActionPost();

        $exp = true;
        $this->assertIsArray($res);
        $this->assertEquals($exp, $res[0]["ip_address"]);
    }

    /**
     * Test the route "indexActionPost" with Lat and Long forecast.
     */
    public function testIndexActionPostWithLatLongForcast()
    {
        $this->di->request->setPost("search", "67, 20");
        $this->di->request->setPost("weather", "forecast");
        $res = $this->controller->indexActionPost();

        $exp = false;
        $exp2 = "forecast";
        $this->assertIsArray($res);
        $this->assertEquals($exp, $res[0]["ip_address"]);
        $this->assertEquals($exp2, $res[0]["weather_type"]);
    }

    /**
     * Test the route "indexActionPost" with lat and long history.
     */
    public function testIndexActionPostWithLatLongHistory()
    {
        $this->di->request->setPost("search", "67, 20");
        $this->di->request->setPost("weather", "history");
        $res = $this->controller->indexActionPost();

        $exp = false;
        $exp2 = "history";
        $this->assertIsArray($res);
        $this->assertEquals($exp, $res[0]["ip_address"]);
        $this->assertEquals($exp2, $res[0]["weather_type"]);
    }

    /**
     * Test the route "indexActionPost" without arguments in body
     */
    public function testIndexActionPostWithOutArgumentsInBody()
    {
        $res = $this->controller->indexActionPost();

        $exp = 400;
        $exp2 = null;
        $this->assertIsArray($res);
        $this->assertEquals($exp, $res[0]["error"]["status"]);
        $this->assertEquals($exp2, $res[0]["error"]["weather"]);
        $this->assertEquals($exp2, $res[0]["error"]["search"]);
    }

    /**
     * Test the route "indexActionPost" with only search in body.
     */
    public function testIndexActionPostWithOnlySearch()
    {
        $this->di->request->setPost("search", "67, 20");
        $res = $this->controller->indexActionPost();

        $exp = 400;
        $exp2 = "Bad Request";
        $exp3 = null;
        $this->assertIsArray($res);
        $this->assertEquals($exp, $res[0]["error"]["status"]);
        $this->assertEquals($exp2, $res[0]["error"]["error"]);
        $this->assertEquals($exp3, $res[0]["error"]["weather"]);
    }

    /**
     * Test the route "indexActionPost" with only weather in body.
     */
    public function testIndexActionPostWithOnlyWeather()
    {
        $this->di->request->setPost("weather", "forecast");
        $res = $this->controller->indexActionPost();

        $exp = 400;
        $exp2 = "Bad Request";
        $exp3 = "'search' missing in body";
        $this->assertIsArray($res);
        $this->assertEquals($exp, $res[0]["error"]["status"]);
        $this->assertEquals($exp2, $res[0]["error"]["error"]);
        $this->assertEquals($exp3, $res[0]["error"]["message"]);
    }

    /**
     * Test the route "indexActionPost" with wrong ip.
     */
    public function testIndexActionPostWithWrongIp()
    {
        $this->di->request->setPost("search", "8.8.8");
        $this->di->request->setPost("weather", "forecast");
        $res = $this->controller->indexActionPost();

        $exp = 404;
        $exp2 = "Not found";
        $exp3 = "Location not found";
        $this->assertIsArray($res);
        $this->assertEquals($exp, $res[0]["error"]["status"]);
        $this->assertEquals($exp2, $res[0]["error"]["error"]);
        $this->assertEquals($exp3, $res[0]["error"]["message"]);
    }

    /**
     * Test the route "indexActionPost" with wrong coordinates.
     */
    public function testIndexActionPostWithWrongCoordinates()
    {
        $this->di->request->setPost("search", "drfhdfh,1dfhdf000");
        $this->di->request->setPost("weather", "forecast");
        $res = $this->controller->indexActionPost();

        $exp = 404;
        $exp2 = "Not found";
        $exp3 = "Location not found";
        // var_dump($res);
        $this->assertIsArray($res);
        $this->assertEquals($exp, $res[0]["error"]["status"]);
        $this->assertEquals($exp2, $res[0]["error"]["error"]);
        $this->assertEquals($exp3, $res[0]["error"]["message"]);
    }
}
