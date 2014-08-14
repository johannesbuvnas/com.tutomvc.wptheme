<?php
namespace tutomvc\theme;
/**
 * The single post template file.
 *
 */
get_header();

get_template_part( 'content', $post->post_type );

if ( comments_open() || get_comments_number() )
{
	comments_template();
}

get_footer();
