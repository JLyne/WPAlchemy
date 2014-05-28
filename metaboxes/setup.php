<?php

include_once TEMPLATEPATH . '/wpalchemy/MetaBox.php';
include_once TEMPLATEPATH . '/wpalchemy/MediaAccess.php';

// global styles for the meta boxes
if (is_admin()) add_action('admin_enqueue_scripts', 'metabox_style');

function metabox_style() {
	wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/metaboxes/meta.css');
}

$wpalchemy_media_access = new WPAlchemy_MediaAccess();
/* eof */