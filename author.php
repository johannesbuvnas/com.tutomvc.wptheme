<?php
namespace tutomvc\theme;
/**
 * The author archive template file
 */
get_header();

get_template_part( "content", "author" );

get_template_part( "loop" );

get_footer();
