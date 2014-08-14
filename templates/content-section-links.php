<?php
/**
*	section.EntryLinks
*/
namespace tutomvc\theme;
global $post;
?>
<!-- .EntryLinks -->
<section class="EntryLinks">
	<div class="Inner">
		<?php
			// Don't print empty markup if there's nowhere to navigate.
			$originalPost = $post;
			$postTypeLabels = get_post_type_labels( get_post_type_object($originalPost->post_type) );
			$previous = get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if($previous)
			{
				echo '<h6><a class="genericon-before genericon-previous" href="'.get_permalink( $previous ).'">'.__("Previous").' '.strtolower($postTypeLabels->singular_name).'</a></h6>';
				$post = $previous;
				get_template_part( "templates/cards/post" );
			}

			if ( $next )
			{
				echo '<h6><a class="genericon-before genericon-next" href="'.get_permalink( $next ).'">'.__("Next").' '.strtolower($postTypeLabels->singular_name).'</a></h6>';
				$post = $next;
				get_template_part( "templates/cards/post" );
			}

			$post = $originalPost;
		?>
	</div>
</section>
<!-- end .EntryLinks -->