<?php

class shsp_widget extends WP_Widget {
	public function __construct() {
		// widget actual processes
		parent::__construct(
			'shsp_widget',
			__('Story Highlights', 'shsp_textdomain'),
			array( 'description' => __('Displays the Story Highlights in the sidebar of single posts.', 'shsp_textdomain') )
		);
	}
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		global $wp_query;
		$postid = $wp_query->post->ID;
		if(is_single($postid) && get_post_meta($postid, '_shsp_title', true)!='') {
			echo $args['before_widget'];
			echo $args['before_title'] . get_post_meta($postid, '_shsp_title', true) . $args['after_title'];
			echo '<ul>';
			echo '<li>' . get_post_meta($postid, '_shsp_li1', true) . '</li>';
			if (get_post_meta($postid,'_shsp_li2',true)!='') echo '<li>' . get_post_meta($postid, '_shsp_li2', true) . '</li>';
			if (get_post_meta($postid,'_shsp_li3',true)!='') echo '<li>' . get_post_meta($postid, '_shsp_li3', true) . '</li>';
			if (get_post_meta($postid,'_shsp_li4',true)!='') echo '<li>' . get_post_meta($postid, '_shsp_li4', true) . '</li>';
			if (get_post_meta($postid,'_shsp_li5',true)!='') echo '<li>' . get_post_meta($postid, '_shsp_li5', true) . '</li>';
			echo '</ul>';
			echo $args['after_widget'];
		}
	}
	public function form( $instance ) {
		// outputs the options form on admin
		?><p>Nothing to see here. Story Highlights move to the sidebar when this widget is placed in any sidebar that appears on single post pages. Set Story Highlights points by editing the post.</p><?php
	}
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		return $instance;
	}
}
add_action( 'widgets_init', create_function( '', 'return register_widget("shsp_widget");' ) );

?>