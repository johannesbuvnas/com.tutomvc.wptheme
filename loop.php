<?php namespace tutomvc\theme;
/**
*	The loop template file.
*/
global $post;
global $wp_query;

$title = __( "Archive", "tutomvc-theme" );
if(is_search()) $title = sprintf( translate_nooped_plural( _n_noop( "%s result for:", "%s results for:", "tutomvc-theme" ), $wp_query->found_posts, "tutomvc-theme" ), $wp_query->found_posts ) . " '".get_search_query() . "'";
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
			<li><span class="glyphicon glyphicon-tags taxonomy-'.$taxonomy->name.'"></span></li>
	';

	$associatedPageToTaxonomy = TaxonomyUtil::getAssociatedPageTaxonomyName( $taxonomy->name );
	if($associatedPageToTaxonomy) $title .= '<li><span class="JSLink" href="'. get_permalink( $associatedPageToTaxonomy ) .'">'.$taxonomy->labels->name.'</span></li>';
	else $title .= '<li>'.$taxonomy->labels->name.'</li>';

	$originalTerm = $term;
	while($term->parent)
	{
		$term = get_term_by( "id", $term->parent, $taxonomy->name );
		$title .= '<li><span class="JSLink" href="'. get_term_link( $term, $taxonomy->name ) .'">'.$term->name.'</span></li>';
	}
	$title .= '<li class="active">'.$originalTerm->name.'</li>';
	$title .= '</ol>';
}
if(is_day() || is_month() || is_year())
{
	$title = '
		<ol class="breadcrumb">
			<li><span class="glyphicon glyphicon-calendar"></span></li>
	';
	$yearLink = is_year() ? "#" : get_year_link( get_the_date( 'Y' ) );
	$monthLink = is_month() ? "#" : get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) );
	$dayLink = is_day() ? "#" : get_day_link( get_the_date( 'Y' ), get_the_date( 'm' ), get_the_date( 'd' ) );
	// $title .= '<li><a href="'.$yearLink.'">'.get_the_date( 'Y' ).'</a></li>';
	if(is_year())
	{
		$title .= '<li class="active">'.get_the_date( 'Y' ).'</li>';
	}
	else
	{
		$title .= '<li><span class="JSLink" href="'.get_year_link( get_the_date( 'Y' ) ).'">'.get_the_date( 'Y' ).'</span></li>';
	}
	if(is_month())
	{
		$title .= '<li class="active">'.get_the_date( 'm' ).'</li>';
	}
	else if(is_day())
	{
		$title .= '<li><span class="JSLink" href="'.get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) ).'">'.get_the_date( 'm' ).'</span></li>';
	}
	if(is_day())
	{
		$title .= '<li class="active">'.get_the_date( 'd' ).'</li>';
	}
	$title .= '</ol>';
}
if(is_author())
{
	$title = sprintf( __( "Published by %s", "tutomvc-theme" ), get_the_author_meta( 'display_name', get_query_var( 'author' ) ) ) . " (".$wp_query->found_posts.")";
}

// if ( have_posts() )
// {
?>
	<section id="loop" class="TheLoop">
		<div class="Inner">
			<section class="Loops">
				<div class="Inner container">
					<ul class="nav nav-tabs" role="tablist">
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
// }