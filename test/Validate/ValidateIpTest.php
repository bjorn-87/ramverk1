<?php

namespace Bjos\Validate;

use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;
use Anax\DI\DIMagic;

/**
 * Test ValidateIpController
 */
class ValidateIpTest extends TestCase
{
    private $validateIp;

    protected function setUp() : void
    {
        $this->validateIp = new ValidateIp();
    }

    /**
     * Test to create an object.
     */
    public function testCreateObject()
    {
        $this->assertInstanceOf("\Bjos\Validate\ValidateIp", $this->validateIp);
    }

    /**
     * Test Validate ip with correct address.
     */
    public function testValidateCorrectIp()
    {
        $res = $this->validateIp->validate("8.8.8.8");
        $exp = true;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test Validate ip with incorrect address.
     */
    public function testValidateIncorrectIp()
    {
        $res = $this->validateIp->validate("8.8.8");
        $exp = false;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test Validate ip with no address in argument.
     */
    public function testValidateIpNoArgument()
    {
        $res = $this->validateIp->validate();
        $exp = false;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test getIpType IPV4.
     */
    public function testGetIpTypeVfour()
    {
        $res = $this->validateIp->getIpType("8.8.8.8");
        $exp = "IPV4";
        $this->assertEquals($exp, $res);
    }

    /**
     * Test getIpType IPV6.
     */
    public function testGetIpTypeVsix()
    {
        $res = $this->validateIp->getIpType("2001:db8::1428:7ab");
        $exp = "IPV6";
        $this->assertEquals($exp, $res);
    }

    /**
     * Test getIpType invalid ip.
     */
    public function testGetIpTypeFail()
    {
        $res = $this->validateIp->getIpType("1.1.1");
        $exp = null;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test getHostName.
     */
    public function testGetHostName()
    {
        $res = $this->validateIp->getHostName("8.8.8.8");
        $exp = "dns.google";
        $this->assertEquals($exp, $res);
    }
}
