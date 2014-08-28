<?php namespace tutomvc\theme;
/**
 *	article.hentry
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="Inner">
		
		<?php get_template_part( "templates/content-header" ); ?>

		<?php if(is_single() || is_page()): ?>
			<section class="EntryContent">
				<div class="Inner BorderBox">
					<?php echo apply_filters( 'the_content', $post->post_content ); ?>
				</div>
			</section><!-- end .EntryContent -->
		<?php endif; ?>

		<?php get_template_part( "templates/content-section-byline" ); ?>
			
		<?php get_template_part( "templates/content-section-discussion" ); ?>

	</section>
</article>