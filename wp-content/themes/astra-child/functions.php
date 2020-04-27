<?php
add_action('wp_enqueue_scripts','wp_enqueue_child_parent_styles',10,1);
function wp_enqueue_child_parent_styles(){

	wp_enqueue_style('parent_style_sheet',get_template_directory_uri()."/style.css");
	wp_enqueue_style('child_style_sheet',get_template_directory_uri()."/style.css",array('parent_style_sheet'));
}
