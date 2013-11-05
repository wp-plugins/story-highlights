<?php
/*
Plugin Name: Story Highlights
Plugin URI: http://wordpress.org/extend/plugins/story-highlights/
Description: Like the "Story Highlights" lists on articles at CNN.com, this adds a bullet list to each post's content via an edit post page panel. 
Author: Dan Birlew
Version: 1.1
Author URI: http://danbirlew.com/
*/
/*  Copyright 2013  Dan Birlew  (email : dan@danbirlew.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    For a copy of the GNU General Public License write to:
	Free Software Foundation, Inc.
	51 Franklin St, Fifth Floor
	Boston, MA  02110-1301  USA
*/
//Let's start by adding a new panel to the edit post page:
add_action( 'add_meta_boxes', 'shsp_add_meta_box' );
function shsp_add_meta_box() {
	add_meta_box(
		'shsp_sectionid',
		__( 'Story Highlights', 'shsp_textdomain' ),
		'shsp_meta_box',
		'post',
		'side'
	);
}
function shsp_meta_box( $post ){
	wp_nonce_field(plugin_basename( __FILE__ ), 'shsp_noncename');
	echo '<strong>* REQUIRED</strong><br/>';
	echo '<label for="sh_title">';
		_e('<strong><big>*</big></strong>Enter list title:<br/>','shsp_textdomain');
	echo '</label>';
	echo '<input type="text" id="sh_title" name="sh_title" value="'. esc_attr(get_post_meta( $post->ID, '_shsp_title', true ) ) . '" size="40" /><br/>';
	echo '<label for="sh_li1">';
		_e('<strong><big>*</big></strong>Enter the first bullet point:<br/>','shsp_textdomain');
	echo '</label>';
	echo '<input type="text" id="sh_li1" name="sh_li1" value="' . esc_attr(get_post_meta( $post->ID, '_shsp_li1', true ) ) . '" size="40" /><br/>';
	echo '<label for="sh_li2">';
		_e('Enter the second bullet point:<br/>','shsp_textdomain');
	echo '</label>';
	echo '<input type="text" id="sh_li2" name="sh_li2" value="' . esc_attr(get_post_meta( $post->ID, '_shsp_li2', true ) ) . '" size="40" /><br/>';
	echo '<label for="sh_li3">';
		_e('Enter the third bullet point:<br/>','shsp_textdomain');
	echo '</label>';
	echo '<input type="text" id="sh_li3" name="sh_li3" value="' . esc_attr(get_post_meta( $post->ID, '_shsp_li3', true ) ) . '" size="40" /><br/>';
	echo '<label for="sh_li4">';
		_e('Enter the fourth bullet point:<br/>','shsp_textdomain');
	echo '</label>';
	echo '<input type="text" id="sh_li4" name="sh_li4" value="' . esc_attr(get_post_meta( $post->ID, '_shsp_li4', true ) ) . '" size="40" /><br/>';
	echo '<label for="sh_li5">';
		_e('Enter the fifth bullet point:<br/>','shsp_textdomain');
	echo '</label>';
	echo '<input type="text" id="sh_li5" name="sh_li5" value="' . esc_attr(get_post_meta( $post->ID, '_shsp_li5', true ) ) . '" size="40" /><br/>';
	echo '<strong>Update your post to save.</strong>';
}
//What happens when we update the post?
add_action( 'save_post', 'shsp_save_postdata', 10, 2 );
function shsp_save_postdata( $post_id, $post ) {
	if ( ! isset( $_POST['shsp_noncename'] ) || ! wp_verify_nonce( $_POST['shsp_noncename'], plugin_basename( __FILE__ ) ) )
		return $post_id;
	$post_type = get_post_type_object( $post->post_type );
	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) return $post_id;
	$shsp_title_data = sanitize_text_field( $_POST['sh_title'] );
	$shsp_li1_data = sanitize_text_field( $_POST['sh_li1'] );
	$shsp_li2_data = sanitize_text_field( $_POST['sh_li2'] );
	$shsp_li3_data = sanitize_text_field( $_POST['sh_li3'] );
	$shsp_li4_data = sanitize_text_field( $_POST['sh_li4'] );
	$shsp_li5_data = sanitize_text_field( $_POST['sh_li5'] );
	update_post_meta($post_id, '_shsp_title', $shsp_title_data);
	update_post_meta($post_id, '_shsp_li1', $shsp_li1_data);
	update_post_meta($post_id, '_shsp_li2', $shsp_li2_data);
	update_post_meta($post_id, '_shsp_li3', $shsp_li3_data);
	update_post_meta($post_id, '_shsp_li4', $shsp_li4_data);
	update_post_meta($post_id, '_shsp_li5', $shsp_li5_data);
}
//Let's add our points to the_content
function shs_points($content) {
	if(is_single($post->ID)){
		if (get_post_meta(get_the_id(), '_shsp_title', true) !='') {
			echo '<div class="shsp">';
			echo '<h1 class="shsp_title">' . get_post_meta(get_the_id(), '_shsp_title', true) . '</h1>';
			echo '<ul id="shsp_ul">';
			echo '<li class="shsp_li1">' . get_post_meta(get_the_id(), '_shsp_li1', true) . '</li>';
			if (get_post_meta(get_the_id(),'_shsp_li2',true)!='') echo '<li class="shsp_li2">' . get_post_meta(get_the_id(), '_shsp_li2', true) . '</li>';
			if (get_post_meta(get_the_id(),'_shsp_li3',true)!='') echo '<li class="shsp_li3">' . get_post_meta(get_the_id(), '_shsp_li3', true) . '</li>';
			if (get_post_meta(get_the_id(),'_shsp_li4',true)!='') echo '<li class="shsp_li4">' . get_post_meta(get_the_id(), '_shsp_li4', true) . '</li>';
			if (get_post_meta(get_the_id(),'_shsp_li5',true)!='') echo '<li class="shsp_li5">' . get_post_meta(get_the_id(), '_shsp_li5', true) . '</li>';
			echo '</ul></div>';
			return $content;
		} else {
			return $content;
		}
	} else {
		return $content;
	}
}
add_filter('the_content','shs_points');
?>