<?php
namespace tutomvc\theme;
/**
 * The post content.
 */
$post = get_post();
// exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="Inner">
		<header class="EntryHeader">
			<?php get_template_part( 'templates/hero' ); ?>
			<section class="EntryTitles">
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
			</section>
		</header>
		<div class="EntryContent">
			<?php the_content(); ?>
		</div>
	</section>
</article>

<?php
	// TODO:
	// wp_link_pages( array(
	// 	'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
	// 	'after'       => '</div>',
	// 	'link_before' => '<span>',
	// 	'link_after'  => '</span>',
	// ) );
?>