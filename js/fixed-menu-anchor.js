/**
 * That file is part of the fixed-menu-anchor plugin.
 */
if (typeof jQuery != 'undefined') {
    jQuery(document).ready(function(){
        // dive into click events for anchors
        jQuery('a[href*="#"]').click(function(e){

            // stop execution in case, the user wants to ignore elements with a certain
            // CSS class.
            if (jQuery(this).hasClass(fixedMenuAnchorCssClassesToBeIgnored)
                && '' != fixedMenuAnchorCssClassesToBeIgnored) {
                return;
            }

            // get top-left position of the target element on the screen
            var top = fixedMenuAnchor_getTopValueOfAnchorTarget(jQuery, this);

            // get distance(user defined) between anchor-target and screen-top.
            var distance = fixedMenuAnchor_getDistance(window.innerWidth);

            // move the screen to the top coordinate minus the user given distance
            jQuery('html, body').animate({scrollTop: top - distance}, 500);
        });
    });
} else {
    console.log('jQuery is not loaded therefore the Fixed Menu Anchor plugin was set inactive.');
}

/**
 * Based on the given window width, the according distance between anchor and top-window position gets returned.
 *
 * @param int windowWidth
 * @returns int Distance set by user.
 */
function fixedMenuAnchor_getDistance(windowWidth)
{
    if (windowWidth <= fixedMenuAnchorMaximumViewportWidth) {
        return fixedMenuAnchorMaximumViewportWidthDistance;
    } else {
        return fixedMenuAnchorUserDefinedDistance;
    }
}

/**
 * Get top value of anchor target.
 *
 * @param object jQ Referene to jQuery. In that way you can test that function without the need of jQuery.
 * @param object anchorLink
 * @return null|int Top position of anchor target, if available, null otherwise.
 */
function fixedMenuAnchor_getTopValueOfAnchorTarget(jQ, anchorLink)
{
    var href = jQ(anchorLink).attr('href');

    // extract name of the anchor target (usually identified via ID or name).
    var anchorName = href.substr(href.indexOf("#")+1);

    // try to find element using name
    var offset = jQ('[name="' + anchorName + '"]').offset();

    // anchor target found by name
    if (null != offset) {
        return offset.top;

    // anchor target was not found by name, try using ID
    } else {
        offset = jQ('[id="' + anchorName + '"]').offset();

        // anchor target found by ID
        if (null != offset) {
            return offset.top;

        } else {
            // anchor target is whether to be found using id nor name.
        }
    }
}
