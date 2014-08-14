<?php
/**
*	The loop template file.
*/
namespace tutomvc\theme;
global $post;
global $wp_query;

if ( have_posts() )
{
	$defaultCardsOptions = array(
		"posts_per_page" => -1
	);

	$groupedQuery = array();

	while ( have_posts() )
	{
		the_post();
		// get_template_part( 'content', $post->post_type );
		if(!array_key_exists($post->post_type, $groupedQuery)) $groupedQuery[ $post->post_type ] = array();
		$groupedQuery[ $post->post_type ][] = get_post( $post );
	}
	$topLevelCardsOptions = array(
		"itemSelector" => ".TopLevelCard",
		"posts_per_page" => -1
	);
	$cardsOptions = array(
		"filter" => "q"
	);
	?>
	<div class="Cards" data-options="<?php echo esc_attr( json_encode( $topLevelCardsOptions ) ); ?>">
		<?php
		foreach($groupedQuery as $postType => $map)
		{
			$postTypeObject = get_post_type_object( $postType );
			$wpQuery = new \WP_Query( array_merge( $wp_query->query_vars, array(
				"post_type" => $postType
			)));
		?>
			<section class="Inner BorderBox TopLevelCard CardsComponent">
				<h6><?php echo $postTypeObject->labels->name ?></h6>
				<div class="Cards" data-options="<?php echo esc_attr( json_encode( $defaultCardsOptions ) ); ?>">
					<?php
						foreach($map as $object)
						{
							$post = $object;
							get_template_part( 'content', $post->post_type );
						}
					?>
				</div>
			</section>
		<?php
		}
		?>
	</div>
	<?php
}