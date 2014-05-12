<?php
namespace tutomvc\theme;

$meta = get_post_meta( $postID, ContentBlockMetaBox::NAME );
if(!isset($meta) || !is_array($meta) || !count($meta)) return;

if(array_key_exists(ContentBlockMetaBox::TYPE, $meta)) $this->parse( "meta", array( $meta ) );

$screenshotThumbnail = FeaturedMediaMetaBox::getScreenshotThumbnailURL( $postID );
?>
<div class="ContentBlockContainer" data-post-id="<?php echo $postID; ?>" data-permalink="<?php echo get_permalink( $postID ); ?>" data-thumbnail="<?php echo $screenshotThumbnail; ?>">
	<?php
	foreach($meta as $value)
	{
		$inner = "";
		$attributes = array();
		unset( $backgroundImage );

		switch($value[ContentBlockMetaBox::TYPE])
		{
			case ContentBlockMetaBox::TYPE_TWO_COLUMN:

					$inner .= '
					<div class="Columns TwoColumns clearfix">
						<div class="Column clearfix"><div class="Wrapper">'.$value[ ContentBlockMetaBox::EDITOR ].'</div></div>
						<div class="Column clearfix"><div class="Wrapper">'.$value[ ContentBlockMetaBox::EDITOR_SECOND ].'</div></div>
					</div>';

			break;
			default:

				$inner .= $value[ ContentBlockMetaBox::EDITOR ];

			break;
		}

		if(is_array($value[ ContentBlockMetaBox::BACKGROUND_IMAGE ]) && count($value[ ContentBlockMetaBox::BACKGROUND_IMAGE ]))
		{
			$backgroundImage = wp_get_attachment_image_src( $value[ ContentBlockMetaBox::BACKGROUND_IMAGE ][0]['id'], "large" );
		}	
	?>
		<?php
			if( is_object($value[ ContentBlockMetaBox::LINK ]) && filter_var($value[ ContentBlockMetaBox::LINK ]->href, FILTER_VALIDATE_URL) )
			{
				$tagName = "a";
				$attributes[] = 'href="'.$value[ ContentBlockMetaBox::LINK ]->href.'"';
				$attributes[] = 'target="'.$value[ ContentBlockMetaBox::LINK ]->target.'"';
				$attributes[] = 'title="'.$value[ ContentBlockMetaBox::LINK ]->title.'"';
			}
			else
			{
				$tagName = "div";
			}
		?>
			<<?php echo $tagName; ?> class="ContentBlock <?php if(isset($backgroundImage)) echo "WithBackgroundImage"; ?>"<?php echo implode(" ", $attributes); ?>>
				<div class="Wrapper">
					<div class="Inner">
						<?php
							if(isset($backgroundImage)):
						?>
							<div class="BackgroundImage ImagePlaceholder" data-src="<?php echo $backgroundImage[0]; ?>" data-width="<?php echo $backgroundImage[1]; ?>" data-height="<?php echo $backgroundImage[2]; ?>">
								<noscript>
									<?php
										echo wp_get_attachment_image( $value[ ContentBlockMetaBox::BACKGROUND_IMAGE ][0]['id'], "large" );
									?>
								</noscript>
							</div>
						<?php
							endif;
						?>
						<div class="TheContent">
							<div class="Inner">
								<?php
									echo apply_filters( "the_content", $inner );
								?>
							</div>
						</div>
					</div>
				</div>
			</<?php echo $tagName; ?>>
	<?php
		}
	?>
</div>
