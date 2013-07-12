=== HW Image Widget ===
Contributors: Håkan Wennerberg
Tags: image widget, image, widget, responsive
Requires at least: 3.5
Tested up to: 3.5.1
Stable tag: 2.3
License: LGPLv3
License URI: http://www.gnu.org/licenses/lgpl-3.0.html

Image widget that will allow you to choose responsive or fixed sized behavior. Includes TinyMCE rich text editing of the text description.

== Description ==

This widget requires WordPress 3.5 or newer.


Primary features of HW Image Widget:

* Allow you to choose responsive or fixed behavior.
* Uses TinyMCE for rich text editing of the image text field.
* Allow you to create a custom widget HTML-template in the active theme to override the default layout.
* Default settings can be overridden using filter.
* Available in English and Swedish.



== Installation ==

Use standard installation process for a plug-in:

1. Install HW Image Widget either via the WordPress.org plugin directory, or by uploading the files to your server.
1. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= Can I change the way the widget is displayed? =

Yes, you can create a file named hwim-template.php in your active theme folder. If this file exists, the HW Image Widget will use that file to render the widget. You can copy the default template as base. It is located in plugins/hw-image-widget/html/front-end.php.

= Can I put the title below the image instead? =

Yes, first you need to create a custom HTML-template for the widget (see above). Then you can use the hwim_title filter to remove the default title placement.

add_filter( 'hwim_title', function( $title ) { return ''; } )

= Can I change the default settings of the widget? =

Yes, you can change the widget default settings by using the hwim_get_defaults filter. It takes a single parameter (array). Default values are:

'title' => '',
'text' => '',
'src' => '',
'display_size' => 'responsive',
'display_width' => '',
'display_height' => '',
'original_width' => '',
'original_height' => '',
'keep_aspect_ratio' => true,
'alt' => '',
'url' => '',
'target_option' => '',
'target_name' => ''

== Screenshots ==

1. Back-end, using responsive behavior.
2. Back-end, using fixed behavior.
3. Editing image text using TinyMCE for rich text editing.
4. Selecting an image.

== Changelog ==

= 2.3 =
* Removed debug snippet.

= 2.2 =
* Fixed bug with the target option.

= 2.1 =
* Fixed JavaScript bug that could cause widget page JavaScrips to fail.
* Gracefully fail on old WordPress versions.

= 2.0 =
* Implemented updated Media Library introduced in WordPress 3.5.
* Updated text editor user interface to be more consistent with WordPress.
* Dropped support for WordPress older then 3.5 to keep it light and wonderful.
* Dropped usage of Twitter Bootstrap.
* Rewrote JavaScript to be less receptive to conflicts with other plugins (could still happen though).
* Fixed TinyMCE editor height when its first opened in the browser. 

= 1.6 =
* Fixed image selection issue when using multiple widgets.
* Play more nicely with other widgets using image selection tool.

= 1.5 =
* Fixed JS-issue with FireFox.

= 1.4 =
* Fixed "From URL" image selection bug.

= 1.3 =
* Clearing image height/width attributes when removing image.
* Fixing width/height not being set in WP 3.5+

= 1.2 =
* Some refactoring to support PHP5 < 5.3
* Dropped loading "optimizations" to improve overall compatability with custom widget area handling plugins. 

= 1.1 =
* Fixed front-end display issue.
* Fixed media upload tab not working.

= 1.0 =
* First version. Why go beta?
