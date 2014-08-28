<?php
namespace tutomvc\theme;
/**
 * The single post template file.
 *
 */
global $post;

get_header();

get_template_part( 'content', $post->post_type );

get_footer();