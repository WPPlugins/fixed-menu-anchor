<?php

namespace PluginsFirst\FixedMenuAnchor;

/**
 *
 */
class Settings
{
    /**
     * Returns all related options for that plugin.
     *
     * @return array
     */
    public function getOptions()
    {
        $result = array(
            'cssClassesToBeIgnored' => \get_option('fixedMenuAnchor_cssClassesToBeIgnored', ''),
            'maximumViewportWidth' => \get_option('fixedMenuAnchor_maximumViewportWidth', 768),
            'maximumViewportWidthDistance' => \get_option('fixedMenuAnchor_maximumViewportWidthDistance', 0),
            'userDefinedDistance' => \get_option('fixedMenuAnchor_userdefineddistance', 0)
        );

        if (is_null($result['cssClassesToBeIgnored'])) {
            $result['cssClassesToBeIgnored'] = '';
        }

        if (is_null($result['maximumViewportWidth'])) {
            $result['maximumViewportWidth'] = 768;
        }

        if (is_null($result['maximumViewportWidthDistance'])) {
            $result['maximumViewportWidthDistance'] = 0;
        }

        if (is_null($result['userDefinedDistance'])) {
            $result['userDefinedDistance'] = 0;
        }

        return $result;
    }

    /**
     * @param string $cssClassesToBeIgnored
     * @param string $maximumViewportWidth
     * @param string $maximumViewportWidthDistance
     * @param string $userDefinedDistance
     */
    public function storeOptions($cssClassesToBeIgnored, $maximumViewportWidth,
        $maximumViewportWidthDistance, $userDefinedDistance)
    {
        // CSS class; if set, each anchor-link will be ignored, if it is attached to that CSS class
        update_option('fixedMenuAnchor_cssClassesToBeIgnored', $cssClassesToBeIgnored, 'yes');

        // 2 values: first sets maxium viewport width, until the second value applys and set distance
        update_option('fixedMenuAnchor_maximumViewportWidth', (int)$maximumViewportWidth, 'yes');
        update_option('fixedMenuAnchor_maximumViewportWidthDistance', (int)$maximumViewportWidthDistance, 'yes');

        // standard distance value to use, if no restrictions for viewport apply
        update_option('fixedMenuAnchor_userdefineddistance', (int)$userDefinedDistance, 'yes');
    }
}
