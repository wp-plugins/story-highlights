=== Story Highlights ===

Contributors: dbirlew
Tags: content
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a bullet list to the start of the post content.

== Description ==

Like the "Story Highlights" lists on articles at CNN.com and other sites, this adds a bullet list to each post's content via an edit post page panel. The plugin sets up the code only, styling can be handled by adding the classes provided under the Other Notes to style.css in your theme.

== Installation ==

1. Upload the folder /story-highlights/ to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

Or:

1. Install the plugin through the Add New Plugins panel
2. Click the "Activate Plugin" link when the install is complete

== Screenshots ==

1. In-post display, right-aligned, with default styles checkbox checked.
2. Widget display in the sidebar.

== Changelog ==

= 1.4 =

* Changed alignment selection to use WordPress core 'alignleft' and 'alignright' classes.
* Added default styles option for those who do not style.
* Widget classes removed. (Now uses your overall sidebar styles.)
* Widget title now uses dynamic sidebar settings. (As set in your theme's functions.php file.)

= 1.3 =

* Added "choose alignment" option on a per-post basis.
* Added sidebar widget. If the widget is active, the post element does not show.

= 1.2 =

* Improved compatibility with several other plugins.
* Vastly improved the output function.

= 1.1 =

* Added screenshot.
* Fixed bug where the_excerpt was not displaying in index or archive pages.

= 1.0 =

* First release.

== Use ==

Add a new post or edit an existing post. A new panel titled "Story Highlights" appears in the right column of the edit post page. If these fields are all blank, the plugin does nothing. To add a "Story Highlights" bullet list to your post, you MUST add a list title and the first bullet point. Otherwise an empty list appears. You may add up to five bullet points, summarizing your post. To delete a bullet point, clear the field. UPDATE your post to save your bullet points.

== Alignment ==

Below the list fields is the option "choose alignment". By default it is set to "none" which inserts the element as a block above the post. Leave this option if you wish to manually apply your own floats to the element. Otherwise choose "left" or "right" to float the element to the right or the left of the first paragraph of your post. Note that floating the list left or right may break your layout if you insert an image at the start of your post.

== Styling ==

This plugin inserts a (mostly) un-styled element above the first paragraph of your post content. The following unique classes and ids can be added to your stylesheet and used to position and style the element, allowing the freedom to style each part individually:
<pre><code>
div.shsp
h1.shsp_title
ul#shsp_ul
li.shsp_li1
li.shsp_li2
li.shsp_li3
li.shsp_li4
li.shsp_li5
</code></pre>
As of version 1.4 checking the box labelled "Use default plugin styles?" will add styles to your source code. This can be enabled/disabled on a per-post basis. However, the recommended method of use is to add the classes above to the style.css file of your theme and style the Story Highlights box your own way, to match your look.

== Widget ==

This plugin adds the Story Highlights widget to the Appearance > Widgets page. Add this widget to the sidebar that will be displayed on single post pages. This widget has no settings. If the widget is active then the post element is not inserted, and the list appears in the sidebar. Remove the widget from the sidebar if you wish to display the element within the post body.