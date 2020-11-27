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
        $this->assertEquals($exp, $res["daily"][0]["dt"]);
    }

    /**
     * Test getHistory
     */
    public function testGetHistory()
    {
        $res = $this->weather->getHistory("76", "20");
        // var_dump($res);
        $exp = "26 Nov 2020";
        $this->assertEquals($exp, $res[0]["current"]["dt"]);
    }
    //
    // /**
    //  * Test Validate ip with incorrect address.
    //  */
    // public function testValidateIncorrectIp()
    // {
    //     $res = $this->weather->validate("8.8.8");
    //     $exp = false;
    //     $this->assertEquals($exp, $res);
    // }
    //
    // /**
    //  * Test Validate ip with no address in argument.
    //  */
    // public function testValidateIpNoArgument()
    // {
    //     $res = $this->weather->validate();
    //     $exp = false;
    //     $this->assertEquals($exp, $res);
    // }
    //
    // /**
    //  * Test getIpType IPV4.
    //  */
    // public function testGetIpTypeVfour()
    // {
    //     $res = $this->weather->getIpType("8.8.8.8");
    //     $exp = "IPV4";
    //     $this->assertEquals($exp, $res);
    // }
    //
    // /**
    //  * Test getIpType IPV6.
    //  */
    // public function testGetIpTypeVsix()
    // {
    //     $res = $this->weather->getIpType("2001:db8::1428:7ab");
    //     $exp = "IPV6";
    //     $this->assertEquals($exp, $res);
    // }
    //
    // /**
    //  * Test getIpType invalid ip.
    //  */
    // public function testGetIpTypeFail()
    // {
    //     $res = $this->weather->getIpType("1.1.1");
    //     $exp = null;
    //     $this->assertEquals($exp, $res);
    // }
    //
    // /**
    //  * Test getHostName.
    //  */
    // public function testGetHostName()
    // {
    //     $res = $this->weather->getHostName("8.8.8.8");
    //     $exp = "dns.google";
    //     $this->assertEquals($exp, $res);
    // }
}
