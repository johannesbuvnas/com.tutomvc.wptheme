<?php
namespace tutomvc\theme;
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 */
get_header();
?>
		<?php
			if ( have_posts() ) 
			{	
				while ( have_posts() )
				{
					the_post();
					global $post;
					get_template_part( 'content', $post->post_type );

					// TODO: Pagination here
				}
			}
			else
			{
				get_template_part( 'content', 'none' );
			}
		?>

<?php
get_footer();
