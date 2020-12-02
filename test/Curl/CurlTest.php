<?php

namespace Bjos\Curl;

use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;
use Anax\DI\DIMagic;

/**
 * Test Curl
 */
class CurlTest extends TestCase
{
    private $curl;

    protected function setUp() : void
    {
        $this->curl = new Curl();
    }

    /**
     * Test to create an object.
     */
    public function testCreateObject()
    {
        $this->assertInstanceOf("\Bjos\Curl\Curl", $this->curl);
    }

    /**
     * Test curl with url.
     */
    public function testCurlWithUrl()
    {
        $url = "test";
        $res = $this->curl->curlApi($url);
        $exp = null;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test curl with no url.
     */
    public function testCurlWithOutUrl()
    {
        $res = $this->curl->curlApi();
        $exp = null;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test multicurl with empty urls.
     */
    public function testMultiCurlWithUrl()
    {
        $url = [
            "",
            ""
        ];
        $res = $this->curl->multiCurlApi($url);
        $exp = null;
        // var_dump($res);

        for ($i=0; $i < 2; $i++) {
            $this->assertEquals($exp, $res[$i]);
        }
        $this->assertCount(2, $res);
    }
}
