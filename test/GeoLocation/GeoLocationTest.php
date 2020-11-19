<?php

namespace Bjos\GeoLocation;

use PHPUnit\Framework\TestCase;

/**
 * Test ValidateIpController
 */
class GeoLocationTest extends TestCase
{
    private $geolocation;

    protected function setUp() : void
    {
        $this->geolocation = new GeoLocation("test.php");
    }

    /**
     * Test to create an object.
     */
    public function testCreateObject()
    {
        $this->assertInstanceOf("\Bjos\GeoLocation\GeoLocation", $this->geolocation);
    }

    /**
     * Test get user ip with HTTP_CLIENT_IP.
     */
    public function testGetUserIpHttpClientIp()
    {
        $_SERVER['HTTP_CLIENT_IP'] = "8.8.8.8";
        $res = $this->geolocation->getUserIp();
        $exp = "8.8.8.8";
        $this->assertEquals($exp, $res);
    }

    /**
     * Test get user with HTTP_X_FORWARDED_FOR.
     */
    public function testGetUserIpHttpXforwardedFor()
    {
        $_SERVER['HTTP_CLIENT_IP'] = null;
        $_SERVER['HTTP_X_FORWARDED_FOR'] = "8.8.8.8";
        $res = $this->geolocation->getUserIp();
        $exp = "8.8.8.8";
        $this->assertEquals($exp, $res);
    }

    /**
     * Test get user with REMOTE_ADDR.
     */
    public function testGetUserIpRemoteAddr()
    {
        $_SERVER['HTTP_X_FORWARDED_FOR'] = null;
        $_SERVER['REMOTE_ADDR'] = "8.8.8.8";
        $res = $this->geolocation->getUserIp();
        $exp = "8.8.8.8";
        $this->assertEquals($exp, $res);
    }

    /**
     * Test get user with no server.
     */
    public function testGetUserIpNoServer()
    {
        // $_SERVER = null;
        $_SERVER['REMOTE_ADDR'] = null;
        $res = $this->geolocation->getUserIp();
        $exp = "X.X.X.X";
        $this->assertEquals($exp, $res);
    }

    /**
     * Test get location without arguments.
     */
    public function testGetLocationNoArguments()
    {
        $res = $this->geolocation->getLocation();
        $exp = null;
        $this->assertEquals($exp, $res);
    }


    /**
     * Test get location with correct ip.
     */
    public function testGetLocationSuccess()
    {
        $ipAdr = "";
        $url = "http://www.student.bth.se/~bjos19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/testapi";
        $option = "";
        $res = $this->geolocation->getLocation($ipAdr, $url, $option);
        $exp = "30000";
        $this->assertEquals($exp, $res["zip"]);
    }
}
