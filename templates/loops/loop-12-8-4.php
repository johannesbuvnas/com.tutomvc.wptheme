<?php namespace tutomvc\theme;
/**
*	Loop results in grid system.
*	First post: 12 column width
*	Second post: 8 column width
*	Third post: 4 column width
*/
?>
<div class="container-fluid">
	<?php
		$i = 0;
		$rows = 0;
		$lastColumnSize = 8;
		while ( have_posts() )
		{
			$i++;
			$rows++;
			the_post();
			if($rows == 1)
			{
			?>
				<div class="row">
					<div class="col-sm-12">
						<?php
							get_template_part( 'content', $post->post_type );
						?>
					</div>
				</div>
			<?php
			}
			else
			{
				if((($i -1) % 2) == 1)
				{
				?>
					<div class="row">
						<div class="col-md-<?php echo $lastColumnSize; ?> col-sm-12">
							<?php
								get_template_part( 'content', $post->post_type );
							?>
						</div>
				<?php
				}
				else
				{
					$lastColumnSize = $lastColumnSize == 8 ? 4 : 8;
				?>
					<div class="col-md-<?php echo $lastColumnSize; ?> col-sm-12">
						<?php
							get_template_part( 'content', $post->post_type );
						?>
					</div>
				<?php
				}

				if((($i -1) % 2) != 1 || $i == count($wp_query->posts))
				{
				?>
					</div><!-- end .row -->
				<?php
				}
			}
		}
	?>
	<?php
		// Set up paginated links.
		$paged        = $wp_query->get("paged") ? intval( $wp_query->get("paged") ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $wp_query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'type' => "list",
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Previous', 'tutomvc-theme' ),
			'next_text' => __( 'Next &rarr;', 'tutomvc-theme' ),
		) );

		if ( $links ) :
	?>
			<div class="row">
				<div class="col-md-12" style="text-align:center;">
					<?php echo $links; ?>
				</div>
			</div><!-- end .row -->
	<?php
		endif;
	?>
</div><!-- end .container-fluid -->