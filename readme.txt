=== Metro Theme Widget Titles ===
Contributors: bhwebworks
Donate link: http://blackhillswebworks.com/donate
Tags: StudioPress Metro theme, widget titles
Requires at least: 3.3
Tested up to: 3.6
Stable tag: 0.2
License: GPLv2 or later

Out of the box, StudioPress Metro theme widget titles are not compatible with some plugins. This plugin fixes that.

== Description ==

The StudioPress Metro theme adds a span tag and class to widget titles using a filter in the theme's functions.php file, and then styles that class with CSS. Unfortunately this method is not compatible with plugins that escape html in widget titles. 

Metro Theme Widget Titles removes the default Metro widget title filter and replaces it with a filter that is compatible with plugins.

**Added in version 0.2**

If you've updated the original Metro theme to HTML5 this plugin will restore the look of the "Leave a Reply" title in the comment form. It may also undo any change you've made to that text. If it does, you can edit the text in the plugin's filter, live with the change, or deactivate the plugin.

If you are using the Metro Pro theme, this plugin will restore the look of your widget titles, comments title, and "Leave a Reply" title to the old Metro theme look.

**This plugin is intended for websites using the Genesis framework, and specifically the StudioPress Metro theme**

== Installation ==

Install this plugin like you would any normal WordPress plugin.

1. Install either via the WordPress.org plugin directory, or by uploading the entire `metro-theme-widget-titles` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. That's it!

== Frequently Asked Questions ==

= Will this plugin work without the Genesis framework? =

No, it won't. This plugin references hooks that are specific to Genesis. If you install it without Genesis it probably won't break your site - it just won't do anything.

= No settings page? =

Nope. This plugin is really simple and does one thing. Well, maybe a couple things now...

== Screenshots ==

1. Example widget title before using this plugin
2. The same widget title after using this plugin

== Changelog ==

= 0.2 =
* Confirm compatibility with WordPress 3.6 and Genesis 2.0
* Restore Metro Pro widget titles to the original Metro style
* Removed screenshots from trunk (they're still in the assets directory)

= 0.1 =
* Initial release