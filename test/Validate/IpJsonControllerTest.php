<?php

namespace Bjos\Validate;

use PHPUnit\Framework\TestCase;
use Anax\DI\DIMagic;

/**
 * Test ValidateIpController
 */
class IpJsonControllerTest extends TestCase
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
        $this->controller = new IpJsonController();
        $this->controller->setDi($di);
    }

    /**
     * Test the route "indexActionGet" no arguments.
     */
    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();
        $this->assertIsArray($res);
    }

    /**
     * Test the route "indexActionPost" with valid IPV4 address.
     */
    public function testIndexActionPostWithValidIpV4()
    {
        $this->di->request->setPost("ip", "1.1.1.1");
        $res = $this->controller->indexActionPost();
        $this->assertIsArray($res);
        $this->assertEquals($res[0]["valid"], true);
    }

    /**
     * Test the route "indexActionPost" with valid IPV6 address.
     */
    public function testIndexActionPostWithValidIpV6()
    {
        $this->di->request->setPost("ip", "2001:db8::1428:7ab");
        $res = $this->controller->indexActionPost();
        $this->assertIsArray($res);
        $this->assertEquals($res[0]["valid"], true);
    }

    /**
     * Test the route "indexActionPost" with invalid ip address.
     */
    public function testIndexActionPostFail()
    {
        $this->di->request->setPost("ip", "1.1.1");
        $res = $this->controller->indexActionPost();
        $this->assertIsArray($res);
        $this->assertEquals($res[0]["valid"], false);
    }

    /**
     * Test the route "indexActionPost" with no ip address in body.
     */
    public function testIndexActionPostNoIpInBody()
    {
        $res = $this->controller->indexActionPost();
        // var_dump($res);
        $this->assertEquals($res[0]["error"]["status"], 400);
    }
}
