<?php

namespace PluginsFirst\FixedMenuAnchor\Test;

use Brain\Monkey;
use PluginsFirst\FixedMenuAnchor\LicenseHandler;
use PluginsFirst\FixedMenuAnchor\Test\Helper\CurlStub;
use PluginsFirst\PluginTestHelper\UnitTestCase;

class LicenseHandlerTest extends UnitTestCase
{
    protected $curlStub;

    public function setUp()
    {
        parent::setUp();

        $this->curlStub = new CurlStub();
        $this->fixture = new LicenseHandler($this->curlStub);
    }

    /*
     * Tests for isPluginUnlocked
     */

    public function testIsPluginUnlockedYes()
    {
        Monkey::functions()->expect('get_option')
            ->once()
            ->andReturn('1');

        $this->assertTrue($this->fixture->isPluginUnlocked());
    }

    public function testIsPluginUnlockedNo()
    {
        Monkey::functions()->expect('get_option')
            ->once()
            ->andReturn(true);

        $this->assertFalse($this->fixture->isPluginUnlocked());
    }

    public function testIsPluginUnlockedNo2()
    {
        Monkey::functions()->expect('get_option')
            ->once()
            ->andReturn(false);

        $this->assertFalse($this->fixture->isPluginUnlocked());
    }

    /*
     * Tests for unlock
     */

    public function testUnlockCodeInvalid()
    {
        $this->curlStub->error = false;
        $this->curlStub->response = 'false';

        $this->assertEquals('false', $this->fixture->unlock('foo'));
    }

    public function testUnlockOk()
    {
        $this->curlStub->error = false;
        $this->curlStub->response = array('result' => true);

        Monkey::functions()->expect('update_option')
            ->once();

        $this->assertTrue($this->fixture->unlock('foo'));
    }

    public function testUnlockError()
    {
        $this->curlStub->error = true;
        $this->curlStub->response = true;

        // check that update_option does not get called
        Monkey::functions()->expect('update_option')
            ->times(0);

        // unlock returns true only, because the server responded it. we wanna
        // check, what unlock returns when an error occured.
        $this->assertTrue($this->fixture->unlock('foo'));
    }
}
