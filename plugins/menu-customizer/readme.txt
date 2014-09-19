=== Menu Customizer ===
Contributors: celloexpressions, wordpressdotorg
Tags: menus, custom menus, customizer, theme customizer, gsoc
Requires at least: 4.0
Tested up to: 4.0
Stable tag: 0.1
Description: Manage your Menus in the Customizer. GSoC Project & WordPress core feature-plugin.
License: GPLv2

== Description ==
This plugin is a WordPress Google Summer of Code 2014 project, soon to be a WordPress core feature-plugin. See the <a href="http://make.wordpress.org/core/tag/menu-customizer/">updates on Make WordPress Core</a> for more information.

The Menu Customizer adds custom menu management to the Customizer. It is not fully functional and in alpha development until further notice; please don't try to run it on a production site. The plugin requires WordPress 4.0 and PHP 5.3 or higher. It is mostly feature-complete and ready for testing, although there are known issues around adding new menus (requires some core work) and working with submenus (try the reorder mode, not drag-and-drop for now). Adding menus items could use some work as well, and is likely to have issues on sites with a large number of posts.

If you're interested in contributing to this project, stay tuned to http://make.wordpress.org/core for updates.

= Core Patches =
Several improvements to the Customizer are also in the works as a part of the GSoC portion of this project, in the form of core patches (for example, the Panels API). See <a href="http://make.wordpress.org/core/2014/07/08/customizer-improvements-in-4-0/">Customizer Improvements in 4.0</a>, and an upcomming Customizer Roadmap for details.

== Installation ==
1. Take the easy route and install through the WordPress plugin adder OR
1. Download the .zip file and upload the unzipped folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Visit the Customizer (Appearance -> Customize) to customize your menus with live previews.

== Changelog ==
See full details here: https://plugins.trac.wordpress.org/log/menu-customizer

= 0.1 =
* Extensive code cleanup.
* First pass at sub-menus, via the buttons in the "reorder" mode.
* Panel tweaks to sync with changes in WordPress core.
* End of GSoC coding period.

= 0.0.6 =
* Implement live-previewing of menus and menu items.
* Use core templating functions in JS.
* Visual improvements to the add-menu-items panel, with scrolling contained within available-item-type sections. More to come here on the code side.

= 0.0.5 =
* Add/delete Menus
* Menu item & menu data is now saved in a scalable way.

= 0.0.4 =
* Add-menu-items
* Use panels

= 0.0.3 =
* Initial commit.

== Upgrade Notice ==
= 0.0.5 =
* Add/delete Menus; Menu item & menu data is now saved in a scalable way.

= 0.0.4 =
* Add-menu-items, use core panels implementation

= 0.0.3 =
* Initial commit.