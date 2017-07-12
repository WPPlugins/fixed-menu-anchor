<?php

namespace PluginsFirst\FixedMenuAnchor;

/**
 * That file is part of the fixed-menu-anchor plugin.
 *
 * Admin area
 */

 // stop execution if user is not a super admin
 if (false == is_super_admin()) {
     echo 'Access denied.';
     exit;
 }

$licenseHandler = new LicenseHandler(new \Curl\Curl());
$settings = new Settings();

// update user distance
if (isset($_REQUEST['fixedMenuAnchor_updateValues'])) {
    $settings->storeOptions(
        // CSS class; if set, each anchor-link will be ignored, if it is attached to that CSS class
        $_REQUEST['fixedMenuAnchor_cssClassesToBeIgnored'],

        // 2 values: first sets maxium viewport width, until the second value applys and set distance
        (int)$_REQUEST['fixedMenuAnchor_maximumViewportWidth'],
        (int)$_REQUEST['fixedMenuAnchor_maximumViewportWidthDistance'],

        // standard distance value to use, if no restrictions for viewport apply
        (int)$_REQUEST['fixedMenuAnchor_userdefineddistance']
    );
}

// get option values. if not set, use standard values
$options = $settings->getOptions();
$freshlyUnlocked = false;
$unlockResponse = false;

// try unlocking plugin
if (isset($_REQUEST['fixedMenuAnchor_unlockCode'])) {
    $unlockResponse = $licenseHandler->unlock($_REQUEST['fixedMenuAnchor_unlockCode']);
    $freshlyUnlocked = $licenseHandler->isPluginUnlocked();
}

// init Twig
\Twig_Autoloader::register();
$loader = new \Twig_Loader_Filesystem(__DIR__ . DIRECTORY_SEPARATOR . 'twig');
$twig = new \Twig_Environment($loader);

if (false == $licenseHandler->isPluginUnlocked()) {
    echo $twig->render(
        'settings-locked.html',
        array(
            'cssClassesToBeIgnored' => $options['cssClassesToBeIgnored'],
            'curlEnabled' => extension_loaded('curl'),
            'unlockResponse' => $unlockResponse,
            'userDefinedDistance' => $options['userDefinedDistance'],
            'version' => FIXEDMENUANCHOR_VERSION,
        )
    );
} else {
    echo $twig->render(
        'settings-unlocked.html',
        array(
            'cssClassesToBeIgnored' => $options['cssClassesToBeIgnored'],
            'freshlyUnlocked' => $freshlyUnlocked,
            'maximumViewportWidth' => $options['maximumViewportWidth'],
            'maximumViewportWidthDistance' => $options['maximumViewportWidthDistance'],
            'userDefinedDistance' => $options['userDefinedDistance'],
            'version' => FIXEDMENUANCHOR_VERSION,
        )
    );
}
