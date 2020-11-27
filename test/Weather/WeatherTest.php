<?php

namespace Bjos\Weather;

use Bjos\Curl\CurlMock;

use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;
use Anax\DI\DIMagic;

/**
 * Test Weatherclass
 */
class WeatherTest extends TestCase
{
    private $weather;

    protected function setUp() : void
    {
        global $di;

        // Setup di
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $this->di = $di;
        $curl = new CurlMock();
        $this->weather = new Weather($curl);
    }

    /**
     * Test to create an object.
     */
    public function testCreateObject()
    {
        $this->assertInstanceOf("\Bjos\Weather\Weather", $this->weather);
    }

    /**
     * Test getWeather.
     */
    public function testGetWeather()
    {
        $res = $this->weather->getWeather("76", "20");
        // var_dump($res);
        $exp = "27 Nov 2020";
        $this->assertEquals($exp, $res[0]["date"]);
    }

    /**
     * Test getHistory
     */
    public function testGetHistory()
    {
        $res = $this->weather->getHistory("76", "20");
        // var_dump($res);
        $exp = "26 Nov 2020";
        $this->assertEquals($exp, $res[0]["date"]);
    }
}
