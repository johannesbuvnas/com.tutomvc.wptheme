<?php namespace tutomvc\theme;
/**
 *	header.EntryHeader
 */
global $post;
$user = get_user_by( "id", $post->post_author );
$subtitle = get_post_meta( $post->ID, TitlesMetaBox::constructMetaKey( TitlesMetaBox::NAME, TitlesMetaBox::SUBTITLE ), TRUE );
?>
<header class="EntryHeader">
	<!-- .HeroBanner -->
	<?php get_template_part( 'templates/hero' ); ?>
	<!-- end .HeroBanner -->
	<!-- .EntryTitles -->
	<section class="EntryTitles">
		<div class="Inner BorderBox">
			<?php if(!is_single() && !is_page()): ?>
				<a class="EntryLink" href="<?php echo get_permalink( $post->ID ); ?>">
			<?php endif; ?>

					<h2 class="EntryTitle"><span class="ShadowBox"><?php the_title(); ?></span></h2>

				<?php if(strlen($subtitle)): ?>

					<h4 class="EntrySubtitle"><span class="ShadowBox"><?php echo $subtitle; ?></span></h4>

				<?php endif; ?>

			<?php if(!is_single() && !is_page()): ?>
				</a><!-- end .EntryLink -->
			<?php endif; ?>

			<?php 
				if(!is_single() && !is_page()): 
			?>
				<h5 class="EntryByline">
						<?php
							$postArchiveLink = $post->post_type != "post" ? get_post_type_archive_link( $post->post_type ) : get_home_url();
							$postTypeObject = get_post_type_object($post->post_type);
							if($postArchiveLink):
						?>
							<a class="ArchiveLink" href="<?php echo get_post_type_archive_link( $post->post_type ); ?>">
								<span><?php echo $postTypeObject->labels->singular_name; ?></span>
							</a>
						<?php else: ?>
							<span><?php echo $postTypeObject->labels->singular_name; ?></span>
						<?php endif; ?>
				<?php if($post->post_type != "page"): ?>
					<span>|</span>
					<a class="AuthorLink" href="<?php echo get_author_posts_url( $user->ID ); ?>">
						<span><?php echo $user->display_name; ?></span>
					</a>
					<span>|</span>
					<a class="EntryLink" href="<?php echo get_permalink( $post->ID ); ?>"><time class="EntryDate" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></a>
				<?php endif; ?>
				</h5>
			<?php endif; ?>
		</div><!-- end .Inner -->
	</section><!-- end .EntryTitles -->
</header><!-- end .EntryHeader -->