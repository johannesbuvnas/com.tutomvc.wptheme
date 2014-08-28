<?php
/**
*	The loop template file.
*/
namespace tutomvc\theme;
global $post;
global $wp_query;

if ( have_posts() )
{
	$title = __( "Archive", "tutomvc-theme" );
	if(is_search()) $title = sprintf( __( "Search Results for: '%s'", "tutomvc-theme" ), get_search_query() );
	if(is_post_type_archive())
	{
		$postTypeObject = get_post_type_object($wp_query->get("post_type"));
		$postTypeLabels = (array)$postTypeObject->labels;
		$title = $postTypeLabels['name'];
	}
	if(is_home())
	{
		$postTypeObject = get_post_type_object("post");
		$postTypeLabels = (array)$postTypeObject->labels;
		$title = $postTypeLabels['name'];
	}

	if(is_tax() || get_query_var( "tag" ) || is_category())
	{
		if(is_tax())
		{
			$taxonomy = get_taxonomy( get_query_var( 'taxonomy' ) );
			$by = filter_var(get_query_var( 'term' ), FILTER_VALIDATE_INT) ? "id" : "slug";
			$term = get_term_by( $by, get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		}
		else if(is_category())
		{
			$taxonomy = get_taxonomy( "category" );
			$by = filter_var(get_query_var( 'term' ), FILTER_VALIDATE_INT) ? "id" : "slug";
			$term = get_term_by( $by, get_query_var( 'category_name' ), "category" );
		}
		else if(get_query_var( "tag" ))
		{
			$taxonomy = get_taxonomy( "post_tag" );
			$by = filter_var(get_query_var( 'tag' ), FILTER_VALIDATE_INT) ? "id" : "slug";
			$term = get_term_by( $by, get_query_var( 'tag' ), "post_tag" );
		}

		$title = '
			<ol class="breadcrumb">
				<li><span class="glyphicon glyphicon-tags"></span></li>
			  <li>'.$taxonomy->labels->name.'</li>
			  <li class="active">'.$term->name.'</li>
			</ol>
		';

		// $title = "<span class='glyphicon glyphicon-tags'></span> " . __( "Archive", "tutomvc-theme" ) .": ". $taxonomy->labels->name . " | " . $term->name;
	}
	if(is_author())
	{
		$user = $wp_query->get_queried_object();
		$title = sprintf( __( "Published by %s", "tutomvc-theme" ), $user->display_name );
	}
?>
	<section id="loop" class="TheLoop">
		<div class="Inner">
			<section class="Loops">
				<div class="Inner container">
					<ul class="nav nav-tabs container" role="tablist">
						<li class="active">
							<a href="#loop1"><?php echo $title; ?></a>
						</li>
					</ul>
					<div class="tab-content">
						<div id="loop1" class="tab-pane active">
							<?php get_template_part( "templates/loops/loop" ); ?>
						</div><!-- end #loop1 -->
					</div><!-- end .tab-content -->
				</div><!-- end .Inner -->
			</section><!-- end .Loops -->
		</div><!-- end .Inner -->
	</section><!-- end .TheLoop -->
<?php
}