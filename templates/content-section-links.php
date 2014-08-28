<?php
/**
*	section.EntryLinks
*/
namespace tutomvc\theme;
global $post;
?>
<!-- .EntryLinks -->
<section class="EntryLinks">
	<div class="Inner BorderBox clearfix">
		<?php
			// Don't print empty markup if there's nowhere to navigate.
			$originalPost = $post;
			$postTypeLabels = get_post_type_labels( get_post_type_object($originalPost->post_type) );
			$previous = get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if($previous)
			{
			?>
				<article class="Previous clearfix">
					<h6><a class="genericon-before genericon-previous" href="<?php echo get_permalink( $previous ); ?>"><?php _e( "Previous", "tutomvc-theme" ); echo strtolower( $postTypeLabels->singular_name ); ?></a></h6>
				<?php
					$post = $previous;
					get_template_part( "templates/cards/post" );
				?>
				</article>
			<?php
			}

			if ( $next )
			{
			?>
				<article class="Next clearfix">
					<h6><a class="genericon-before genericon-next" href="<?php echo get_permalink( $next ); ?>"><?php _e( "Next", "tutomvc-theme" ); echo strtolower( $postTypeLabels->singular_name ); ?></a></h6>
				<?php
					$post = $next;
					get_template_part( "templates/cards/post" );
				?>
				</article>
			<?php
			}

			

			$post = $originalPost;
		?>
	</div>
</section>
<!-- end .EntryLinks -->