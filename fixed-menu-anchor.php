<?php

/**
 * That file is part of the fixed-menu-anchor plugin.
 */

/**
 * Plugin Name: Fixed Menu Anchor
 * Plugin URI: https://wordpress.org/plugins/fixed-menu-anchor
 * Version: 2.2.1
 * Description: Having problems with a fixed header/menu which overlaps the target of an anchor? Use this plugin to jump just before the target so that the fixed header/menu does not overlap anymore.
 * Author: Konrad Abicht, Marc Sauerwald
 * Author URI: https://www.plugins-first.io
 * License: GPLv2 or later
 */

require_once 'vendor/autoload.php';

if (!defined('FIXEDMENUANCHOR_VERSION')) {
    define('FIXEDMENUANCHOR_VERSION', '2.2');
}

// when not in admin area ...
if (false == is_admin())
{
    function fixedMenuAnchor_enqueueScripts()
    {
        // register the JS file to handle the jumps later on (loads it after jquery)
        wp_enqueue_script(
            'fixed-menu-anchor',
            plugins_url('/js/fixed-menu-anchor.js', __FILE__),
            array('jquery'),
            true
        );

        // if plugin is in test mode, add unit tests and qunit to javascript section
        $isTestModeOn = isset($_REQUEST['test']);
        if ($isTestModeOn) {
            // current folder
            $path = basename(dirname(__FILE__));

            // test vendors
            wp_enqueue_script('qunit', path_join(WP_PLUGIN_URL, $path . '/js-tests/vendor/unit.js'), array('jquery'));

            // fixed-menu-anchor-tests
            wp_enqueue_script(
                'fixed-menu-anchor-tests',
                path_join(WP_PLUGIN_URL, $path .'/js-tests/unit-tests.js'),
                array('jquery')
            );
        }
    }

    function fixedMenuAnchor_setFrontendVariables()
    {
        $settings = new \PluginsFirst\FixedMenuAnchor\Settings();
        $options = $settings->getOptions();

        // fetch values from database
        $cssClassesToBeIgnored = $options['cssClassesToBeIgnored'];
        $maximumViewportWidth = $options['maximumViewportWidth'];
        $maximumViewportWidthDistance = $options['maximumViewportWidthDistance'];
        $userDefinedDistance = $options['userDefinedDistance'];

        // inject them into the frontend's head so that our javascript can use it later on.
        echo '<script type="text/javascript">' .
             'var fixedMenuAnchorCssClassesToBeIgnored = "' . $cssClassesToBeIgnored . '";'.
             'var fixedMenuAnchorMaximumViewportWidth = "' . $maximumViewportWidth . '";'.
             'var fixedMenuAnchorMaximumViewportWidthDistance = "' . $maximumViewportWidthDistance . '";'.
             'var fixedMenuAnchorUserDefinedDistance = "' . $userDefinedDistance . '";'.
             '</script>';
    }

    add_action('wp_enqueue_scripts', 'fixedMenuAnchor_enqueueScripts');
    add_action('wp_head', 'fixedMenuAnchor_setFrontendVariables');


// when in admin area ...
} else {
    function fixedMenuAnchor_adminInit()
    {
        // stop execution if user is not a super admin
        if (false == is_super_admin()) {
            return false;
        }

        // add Plugins1st button to admin main menu
        add_submenu_page(
            'themes.php',
            'Fixed Menu Anchor',
            'Fixed Menu Anchor',
            'manage_options',
            'fixedMenuAnchor',
            'fixedMenuAnchor_adminSettings'
        );
    }

    function fixedMenuAnchor_adminSettings()
    {
        require_once 'admin/settings.php';
    }

    add_action('admin_menu', 'fixedMenuAnchor_adminInit');

    /*
     * add Settings link in plugin view
     */
    add_filter('plugin_action_links', 'fixedMenuAnchor_plugin_action_links', 10, 2);
    function fixedMenuAnchor_plugin_action_links($links, $file)
    {
        static $this_plugin;

        if (!$this_plugin) {
            $this_plugin = plugin_basename(__FILE__);
        }

        if ($file == $this_plugin) {
            // The 'page' query string value must be equal to the slug
            // of the Settings admin page we defined earlier, which in
            // this case equals 'myplugin-settings'.
            $settings_link = '<a href="' . get_bloginfo('wpurl')
                             .'/wp-admin/admin.php?page=fixedMenuAnchor">Settings</a>';
            array_unshift($links, $settings_link);
        }

        return $links;
    }
}
