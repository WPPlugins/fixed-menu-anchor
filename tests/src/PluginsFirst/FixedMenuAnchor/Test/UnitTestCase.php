<?php

namespace PluginsFirst\FixedMenuAnchor\Test;

use Brain\Monkey;

class UnitTestCase extends \PHPUnit_Framework_TestCase
{
    protected $fixture;

    public function setUp()
    {
        Monkey::setUpWP();
    }

    public function tearDown()
    {
        Monkey::tearDownWP();
    }
}
