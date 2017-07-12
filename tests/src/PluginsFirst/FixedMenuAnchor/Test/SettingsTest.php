<?php

namespace PluginsFirst\FixedMenuAnchor\Test;

use Brain\Monkey;
use PluginsFirst\FixedMenuAnchor\Settings;
use PluginsFirst\PluginTestHelper\UnitTestCase;
use RedBeanPHP\R;

class SettingsTest extends UnitTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->fixture = new Settings();
    }

    public function testGetOptions()
    {
        Monkey::functions()->expect('get_option')
            ->times(4);

        $this->assertEquals(
            array(
                'cssClassesToBeIgnored' => '',
                'maximumViewportWidth' => 768,
                'maximumViewportWidthDistance' => 0,
                'userDefinedDistance' => 0
            ),
            $this->fixture->getOptions()
        );
    }

    public function testStoreOptions()
    {
        // be sure to have certain values set
        $this->assertEquals(
            array(
                'cssClassesToBeIgnored' => '',
                'maximumViewportWidth' => '768',
                'maximumViewportWidthDistance' => '0',
                'userDefinedDistance' => '0'
            ),
            $this->fixture->getOptions()
        );

        Monkey::functions()->expect('update_option')
            ->times(4);

        // change options
        $this->fixture->storeOptions(
            '1',  // $cssClassesToBeIgnored
            '2',  // $maximumViewportWidth
            '3',  // $maximumViewportWidthDistance
            '4'   // $userDefinedDistance
        );
    }
}
