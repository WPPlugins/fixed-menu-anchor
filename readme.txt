=== Plugin Name ===
Contributors: k00ni
Tags: anchor, fixed menu, fixed header, sticky header, sticky menu, cookie banner
Requires at least: 4.3
Tested up to: 4.5.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

If you are using a sticky, fixed menu or header in your WP theme, this plugin is the best to deal with them overlapping anchored content.

== Description ==

If you are using a sticky, fixed menu or header in your WordPress theme, this plugin is the best to deal with menus or headers overlapping your anchored content. Insert exact menu height to jump before your anchor target. With the PRO version you can also adjust the value for a mobile breakpoint by width.

> **Premium Support** <br>
> The Plugins First team provides active one to one email support for the Fixed Menu Anchor plugin, for people who bought [Fixed Menu Anchor Pro](https://plugins-first.io/en/product/fixed-menu-anchor-wordpress-plugin/). The PRO version not only comes with additional support, but also provides a feature for mobile-first themes. Check it out!

> **General Support and Bug Reports** <br>
> General support is provided within the [Support area](https://wordpress.org/support/plugin/fixed-menu-anchor) of WordPress.org, where you can also report bugs.

= Highlights =

* Simple, easy to configure / setup
* You can define a standard distance between screen top and anchor target, which will be used whenever maximum viewport does not apply.
* Define a certain CSS-class, when it is attached on a link, the click event will be ignored.
* Define a maximum viewport width until a certain distance between screen top and anchor target is to be used (relevant for mobile optimized header - *only PRO version*).
* Browser agnostic – It is fully compatible with all major browsers: Firefox, Chromium/Chrome, Safari, Opera, Edge
* Theme agnostic – You can use it in every theme as long as jQuery library is loaded.
* Tested up to WordPress 4.5

== Installation ==

1. Upload plugin folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Appearence->Fixed Menu Anchor and choose the distance value.
4. That value should be a little bit higher than the fixed header/menu of yours.
5. After saving the value, you should jump in front of each anchor-target without the concerning about overlayed content anymore.

== Setup and Usage ==

* Go to Appearence->Fixed Menu Anchor and choose the distance value.
* That value should be a little bit higher than the fixed header/menu of yours.
* After saving the value, you should jump in front of each anchor-target without the concerning about overlayed content anymore.

== Frequently Asked Questions ==

= 1. Why does it jumps when i click to an entry in my accordion/tab-menu? =

Because the algorithm looks for the # sign in the URL. Unfortunately accordions and other menu-like structures using # to reference a target. That is getting in the way of the plugin. But in version 2 we introduced a new feature, which allows you to set a CSS class and the plugin will ignore all links using that CSS class.

= 2. Can i forbid the plugin to fire? =

Yes, you set a CSS class which indicates, that the plugin is prohibit from being activated by a click event.

= 3. I am using a mobile first theme and the header-menu changes based on the screen width. Do you support different header heights? =

Yes, with version 2 (only pro version), we introduced a feature, that lets you set a certain screen width and a value for the distance, which only applies until that width is reached. After the width is higher, the default value will be used.

= 4. I got weird behavior after clicking an anchor (e.g. moving to the bottom and jumps back immediately)! =

We got feedback from users that they experienced weird behavior when clicking an anchor. In *almost all cases* another plugin or a custom Java Script of the theme is interfering with the Fixed Menu Anchor plugin. The reason is, that it kinda capturing the click event to apply a certain behavior for anchor-links. If you have the same problem, please deactivate other plugins first and see if the problem goes away. If it persists, create a post in the [support forum](http://wordpress.org/support/plugin/fixed-menu-anchor), together with a detailled description of your setup (e.g. installed plugins, active theme). We will look into it and getting back to you.

== Screenshots ==

1. Before and after view - On the right side you see how it looks *without* this plugin: your anchor-target is overlapped by the sticky header/menu. In comparison to that, on the left side, you see how it looks *with* this plugin: you will jump a little bit before the anchor-target so it will not be overlapped.
2. View of the backend (PRO version).
3. View of the backend (Limited version).

== Changelog ==
= 2.1 =
* Adapted to fit new requirements for WordPress 4.5
* Improved readme.txt

= 2.0.0 - 2.0.4 =
* Added new features:
  * you can now define a maximum viewport width until a certain distance is to be used (only pro version).
  * you can define a certain CSS-class, when it is attached on a link, the click event will be ignored
* implemented test environment on PHP and JavaScript level to improve stability and reduce bugs
* tested plugin if compatible with standard theme of WordPress 4.4.2
* added shortcut in plugin view to reach settings page faster after activation
* bug fixing
* removed unnecessary files  (e.g. documentation of used vendors)

= 1.0.3 =
* Added helpful information for the community to participate in the future development of the plugin.

= 1.0.2 =
* Small adaptions to provide more good information for later usage.

= 1.0.1 =
* Added support for `id` attribute to be used to determine a target to jump to

= 1.0.0 =
* First release; introducing a way to jump right before an anchor target
* Anchor target recognized using `name` attribute.
