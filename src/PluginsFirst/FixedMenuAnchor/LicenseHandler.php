<?php

namespace PluginsFirst\FixedMenuAnchor;

use Curl\Curl;

/**
 *
 */
class LicenseHandler
{
    /**
     * @param Curl $curl
     */
    public function __construct(Curl $curl)
    {
        $this->curl = $curl;
    }

    /**
     * Tells you, if the plugin is unlocked or not.
     *
     * @return true|array True if validation worked, array otherwise.
     */
    public function isPluginUnlocked()
    {
        return '1' === get_option('fixedMenuAnchor_pluginUnlocked', false);
    }

    /**
     * Validates a given serial key on the plugins first server.
     *
     * @param string $serialKey Serial key the user got after purchase.
     * @return boolean
     */
    public function unlock($code)
    {
        $this->curl->get(
            'https://plugins-first.io/en/wp-admin/admin-ajax.php'.
                '?action=validate_license_key'.
                '&generateLicenseKey-licenseKey='. trim($code)
        );

        // transform JSON response to array
        $jsonResponse = json_decode(json_encode($this->curl->response), true);

        // unlock plugin capabilities
        if (false == $this->curl->error && isset($jsonResponse['result']) && true == $jsonResponse['result']) {
            update_option('fixedMenuAnchor_pluginUnlocked', '1', 'yes');
            return true;
        } else {
            return $jsonResponse;
        }
    }
}
