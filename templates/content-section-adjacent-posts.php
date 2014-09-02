<?php namespace tutomvc\theme;
/**
*	section.AdjacentPosts
*/
global $post;
$postTypeLabels = get_post_type_labels( get_post_type_object($post->post_type) );
$previous = get_adjacent_post( false, '', true );
$next = get_adjacent_post( false, '', false );
$adjacentPosts = array();
if($next) $adjacentPosts[] = $next;
if($previous) $adjacentPosts[] = $previous;
$colClasses = array("AdjacentPost col-xs-12");
// if(count($adjacentPosts) > 1) $colClasses[] = "col-md-6";
?>
<!-- .EntryLinks -->
<section class="AdjacentPosts container-fluid">
	<div class="Inner row">
		<?php
			foreach($adjacentPosts as $post)
			{
				$subtitle = get_post_meta( $post->ID, TitlesMetaBox::constructMetaKey( TitlesMetaBox::NAME, TitlesMetaBox::SUBTITLE ), TRUE );
				$user = get_user_by( "id", $post->post_author );
				if($post == $next) $adjacentTitle = __( "Next", "tutomvc-theme" );
				else $adjacentTitle = __( "Previous", "tutomvc-theme" );
				$featuredImageID = HeroBannerMetaBox::getFeaturedImageID( $post->ID );
				$styles = array();
				if($featuredImageID)
				{
					$src = wp_get_attachment_image_src( $featuredImageID, "post-thumbnail" );
					$styles[] = "background-image: url(".$src[0].");";
				}
			?>
				<article class="<?php echo implode(" ", $colClasses); ?>" style="<?php echo implode(" ", $styles); ?>">
					<a class="EntryLink" href="<?php echo get_permalink( $post->ID ); ?>">
						<div class="Inner">
							<header>
								<p class="AdjacentTitle"><?php echo $adjacentTitle ?></p>
								<h2 class="EntryTitle"><?php the_title(); ?></h2>
							<?php if(strlen($subtitle)): ?>
								<h4 class="EntrySubtitle"><?php echo $subtitle; ?></h4>
							<?php endif; ?>
							<h5 class="EntryByline">
								<span><?php echo $user->display_name; ?></span>
								<span>|</span>
								<time class="EntryDate" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
							</h5>
							</header>
						</div>
					</a>
				</article>
			<?php
			}
		?>
	</div>
</section><!-- end .AdjacentPosts -->