<?php
/*
Plugin Name: Story Highlights
Plugin URI: http://wordpress.org/extend/plugins/story-highlights/
Description: Like the "Story Highlights" lists on articles at CNN.com and other sites, this adds a bullet list to each post's content via an edit post page panel.
Author: Dan Birlew
Version: 1.4
Author URI: http://danbirlew.com/
*/
/*  Copyright 2014  Dan Birlew  (email : dan@danbirlew.com)

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
defined('ABSPATH') or die("No script kiddies please!");

//Includes:
include 'widget.php';

//Let's add a new panel to the edit post page:
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
	echo '<p style="font-weight:bold">* REQUIRED FOR PROPER DISPLAY</p>';

	echo '<p><label for="sh_title">';
		_e('<strong><big>*</big></strong>Enter list title:<br/>','shsp_textdomain');
	echo '<input type="text" id="sh_title" class="widefat" name="sh_title" value="'. esc_attr(get_post_meta( $post->ID, '_shsp_title', true ) ) . '" /></label></p>';

	echo '<p><label for="sh_li1">';
		_e('<strong><big>*</big></strong>Enter the first bullet point:<br/>','shsp_textdomain');
	echo '<input type="text" id="sh_li1" class="widefat" name="sh_li1" value="' . esc_attr(get_post_meta( $post->ID, '_shsp_li1', true ) ) . '" /></label>';
	
	echo '<label for="sh_li2">';
		_e('Second bullet point:<br/>','shsp_textdomain');
	echo '<input type="text" id="sh_li2" class="widefat" name="sh_li2" value="' . esc_attr(get_post_meta( $post->ID, '_shsp_li2', true ) ) . '" /></label>';
	
	echo '<label for="sh_li3">';
		_e('Third bullet point:<br/>','shsp_textdomain');
	echo '<input type="text" id="sh_li3" class="widefat" name="sh_li3" value="' . esc_attr(get_post_meta( $post->ID, '_shsp_li3', true ) ) . '" /></label>';
	
	echo '<label for="sh_li4">';
		_e('Fourth bullet point:<br/>','shsp_textdomain');
	echo '<input type="text" id="sh_li4" class="widefat" name="sh_li4" value="' . esc_attr(get_post_meta( $post->ID, '_shsp_li4', true ) ) . '" /></label>';

	echo '<label for="sh_li5">';
		_e('Fifth bullet point:<br/>','shsp_textdomain');
	echo '<input type="text" id="sh_li5" class="widefat" name="sh_li5" value="' . esc_attr(get_post_meta( $post->ID, '_shsp_li5', true ) ) . '" /></label></p>';

	echo '<p>Choose alignment:<br/>';
	$align=get_post_meta($post->ID, '_shsp_align', true); ?>

	<input type="radio" name="sh_align" id="none" value="0" <?php if($align==0){echo 'checked="checked"';} ?>><label for="none">None</label> <input type="radio" name="sh_align" id="left" value="1" <?php if($align==1){echo 'checked="checked"';} ?>><label for="left">Left</label> <input type="radio" name="sh_align" id="right" value="2" <?php if($align==2){echo 'checked="checked"';} ?>><label for="right">Right</label></p>
	
	<p><input type="checkbox" name="sh_style" value="1" <?php $style=get_post_meta($post->ID, '_shsp_style', true); if($style==1){echo 'checked="checked"';} ?>><label for="sh_style">Use default plugin styles?</label></p>

	<?php
	echo '<p style="font-weight:bold">Update your post to save.</p>';
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
	update_post_meta($post_id, '_shsp_align', $_POST["sh_align"]);
	update_post_meta($post_id, '_shsp_style', $_POST["sh_style"]);
}

//Let's add our points to the_content
function shs_points($content = null) {
	$shsPoints = '';
	if(is_single($post->ID) && !is_active_widget(false, false, 'shsp_widget')){
		if (get_post_meta(get_the_id(), '_shsp_title', true) !='') {
			$shsPoints.= '<div class="shsp';
			$sh_align=get_post_meta(get_the_id(), '_shsp_align', true);
			if($sh_align==1){
				$shsPoints.= ' alignleft';
			} elseif($sh_align==2) {
				$shsPoints.= ' alignright';
			}
			$shsPoints.= '">';
			$shsPoints.= '<h3 class="shsp_title">' . get_post_meta(get_the_id(), '_shsp_title', true) . '</h3>';
			$shsPoints.= '<ul id="shsp_ul">';
			$shsPoints.= '<li class="shsp_li1">' . get_post_meta(get_the_id(), '_shsp_li1', true) . '</li>';
			if (get_post_meta(get_the_id(),'_shsp_li2',true)!='') $shsPoints.= '<li class="shsp_li2">' . get_post_meta(get_the_id(), '_shsp_li2', true) . '</li>';
			if (get_post_meta(get_the_id(),'_shsp_li3',true)!='') $shsPoints.= '<li class="shsp_li3">' . get_post_meta(get_the_id(), '_shsp_li3', true) . '</li>';
			if (get_post_meta(get_the_id(),'_shsp_li4',true)!='') $shsPoints.= '<li class="shsp_li4">' . get_post_meta(get_the_id(), '_shsp_li4', true) . '</li>';
			if (get_post_meta(get_the_id(),'_shsp_li5',true)!='') $shsPoints.= '<li class="shsp_li5">' . get_post_meta(get_the_id(), '_shsp_li5', true) . '</li>';
			$shsPoints.= '</ul></div>';
			if(get_post_meta(get_the_id(),'_shsp_style',true)==1)
			$shsPoints.= 
				'<style>
				.shsp{
					border:1px solid #ccc;
					border-radius:10px;
					padding:15px 10px;
					margin-bottom:15px;
					font-size:85%;
					background: #ffffff;
					background: -moz-linear-gradient(top,  #ffffff 0%, #f2f2f2 100%);
					background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#f2f2f2));
					background: -webkit-linear-gradient(top,  #ffffff 0%,#f2f2f2 100%);
					background: -o-linear-gradient(top,  #ffffff 0%,#f2f2f2 100%);
					background: -ms-linear-gradient(top,  #ffffff 0%,#f2f2f2 100%);
					background: linear-gradient(to bottom,  #ffffff 0%,#f2f2f2 100%);
					filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#ffffff", endColorstr="#f2f2f2",GradientType=0 );
				}
				.shsp.alignright,
				.shsp.alignleft{
					max-width:33%;
				}
				.shsp.alignleft{
					margin:0 10px 10px 0;
				}
				.shsp.alignright{
					margin:0 0 10px 10px;
				}
				.shsp_title{
					text-transform:uppercase;
				}
				#shsp_ul li{
					list-style:none;
					text-indent:-0.625em;
				}
				#shsp_ul li:before{
					content:"\2022";
					color:red;
					position:relative;
					left:-10px;
					font-size:115%;
				}
				</style>';
			$shsPoints.= $content;
			return $shsPoints;
		} else {
			return $content;
		}
	} else {
		return $content;
	}
}
add_filter('the_content','shs_points');

?>