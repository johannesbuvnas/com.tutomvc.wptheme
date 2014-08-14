<?php
namespace tutomvc\theme;
/**
 *	The search template file
 */
get_header();
?>
<h2 id="pageHeader">
	<?php printf( __( 'Search Results for: %s', 'tutomvc' ), get_search_query() ); ?>
</h2><!-- .page-header -->
<?php
get_template_part( "loop" );

get_footer();
