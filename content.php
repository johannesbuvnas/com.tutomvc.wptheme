<?php
/**
 *	article.hentry
 */
namespace tutomvc\theme;
if(!is_single() && !is_page())
{
	get_template_part( "templates/cards/post" );
	return;
}
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="Inner">
		<header class="EntryHeader">
			<!-- .HeroBanner -->
			<?php get_template_part( 'templates/hero' ); ?>
			<!-- end .HeroBanner -->
			<!-- .EntryTitles -->
			<section class="EntryTitles">
				<div class="Inner BorderBox">
					<h2 class="EntryTitle">
						<span class="ShadowBox"><?php the_title(); ?></span>
					</h2>
					<?php
						$subTitle = get_post_meta( $post->ID, TitlesMetaBox::constructMetaKey( TitlesMetaBox::NAME, TitlesMetaBox::SUBTITLE ), TRUE );

						if(strlen($subTitle))
						{
						?>
							<h4 class="EntrySubtitle">
								<span class="ShadowBox"><?php echo $subTitle; ?></span>
							</h4>
						<?php
						}
					?>
				</div>
			</section>
			<!-- .EntryTitles -->
		</header>
		<!-- .EntryContent -->
		<section class="EntryContent">
			<div class="Inner BorderBox">
				<?php echo apply_filters( 'the_content', $post->post_content ); ?>
			</div>
		</section>
		<!-- end .EntryContent -->
		<?php if(is_single()): ?>
			
			<?php get_template_part( "templates/content-section-byline" ); ?>

			<?php get_template_part( "templates/content-section-links" ); ?>			

		<?php endif; ?>
	</section>
</article>