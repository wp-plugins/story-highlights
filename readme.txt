=== Story Highlights ===

Contributors: dbirlew
Tags: content
Requires at least: 3.0.1
Tested up to: 3.5.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Like the "Story Highlights" lists on articles at CNN.com, this adds a bullet list to each post's content via an edit post page panel.

== Installation ==

1. Upload the folder /story-highlights/ to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

Or:

1. Install the plugin through the Add New Plugins panel.
2. Click the "Activate Plugin" link when the install is complete.


== Screenshots ==

No screenshots.

== Changelog ==

= 1.0 =

* First release.

== Use ==

After installation and activation, add a new post or edit an existing post. A new panel titled "Story Highlights" appears in the right column of the edit post page. If these fields are all blank, the plugin inserts nothing. To add a bulleted "Story Highlights" list to your story, you MUST add a list title (therefore, it doesn't have to be titled "Story Highlights") and the first bullet point. Otherwise the plugin won't insert the list. You may add up to five bullet points, summarizing your post. To delete a bullet point, clear the field. Click the UPDATE button to save your bullet points.

== Styling ==

This plugin inserts an unstyled element above your post content. The following unique styles can be added to your stylesheet and used to position and style the element:

div.shsp
h1.shsp_title
ul#shsp_ul
li.shsp_li1
li.shsp_li2
li.shsp_li3
li.shsp_li4
li.shsp_li5

This allows you the freedom to style each element individually.

== Quick Styling ==

No clue what I'm talking about in the Styling section? Access your theme files in the Appearance Editor panel. Your main stylesheet should load first. At the end, insert either of the following codes:

/* Copy this into your theme's stylesheet to make your Story Highlights align left */
.shsp{
	width:25%;
	padding:10px;
	float:left;
	margin: 0 10px 10px 0;
}

/* Or, align it right: */
.shsp{
	width:25%;
	padding:10px;
	float:right;
	margin: 0 0 10px 10px;
}

Either code above will get you started, anyway.

== Future Releases? ==

* Maybe an option to display the list in the sidebar instead?
* Maybe allow HTML within the bullet points? That way you can add "NEW!" in red like CNN does.

This is my first plugin so I'll have to research these options. Thanks for your patience.