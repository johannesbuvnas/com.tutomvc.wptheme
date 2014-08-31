<?php
namespace tutomvc\theme;
/**
 * The single post template file.
 *
 */
global $post;
global $themeFacade;

get_header();

while ( have_posts() )
{
	the_post();
	get_template_part( 'content', $post->post_type );
}

get_footer();