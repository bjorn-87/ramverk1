<?php

namespace Bjos\Validate;

use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;
use Anax\DI\DIMagic;

/**
 * Test ValidateIpController
 */
class ValidateIpControllerTest extends TestCase
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
        $this->controller = new ValidateIpController();
        $this->controller->setDi($di);
    }

    /**
     * Test the route "indexAction" with valid IPV4 address.
     */
    public function testIndexActionWithValidIpV4()
    {
        $this->di->request->setGet("ip", "1.1.1.1");
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "indexAction" with valid IPV6 address.
     */
    public function testIndexActionWithValidIpV6()
    {
        $this->di->request->setGet("ip", "2001:db8::1428:7ab");
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "indexAction" with invalid ip address.
     */
    public function testIndexActionFail()
    {
        $this->di->request->setGet("ip", "1.1.1");
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
