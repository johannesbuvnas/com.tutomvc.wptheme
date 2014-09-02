<?php
namespace tutomvc\theme;
/**
 * The single post template file.
 *
 */
global $post;

get_header();

while ( have_posts() )
{
	the_post();
	get_template_part( 'content', $post->post_type );
	get_template_part( "templates/content-section", "adjacent-posts" );
}

get_footer();
