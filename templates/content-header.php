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
			<h2 class="EntryTitle">
				<?php if(!is_single() && !is_page()): ?>
				<a href="<?php echo get_permalink( $post->ID ); ?>">
					<?php the_title(); ?>
				</a>
					<?php else: ?>
					<span class="ShadowBox"><?php the_title(); ?></span>
				<?php endif; ?>
			</h2>
			<?php if(strlen($subtitle)): ?>
				<h4>
					<?php if(!is_single() && !is_page()): ?>
						<a href="<?php echo get_permalink( $post->ID ); ?>">
							<?php if(strlen($subtitle)): ?>
								<span class="ShadowBox"><?php echo $subtitle; ?></span>
							<?php endif; ?>
						</a>
					<?php else: ?>
							<span class="ShadowBox"><?php echo $subtitle; ?></span>
					<?php endif; ?>
				</h2>
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
							|
						<?php else: ?>
							<span><?php echo $postTypeObject->labels->singular_name; ?></span>
							|
						<?php endif; ?>
					<a class="AuthorLink" href="<?php echo get_author_posts_url( $user->ID ); ?>">
						<span><?php echo $user->display_name; ?></span>
					</a>
					|
					<a href="<?php echo get_permalink( $post->ID ); ?>"><time class="EntryDate" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></a>
				</h5>
			<?php endif; ?>
		</div>
	</section><!-- end .EntryTitles -->
</header><!-- end .EntryHeader -->