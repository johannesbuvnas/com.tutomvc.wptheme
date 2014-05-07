<?php
namespace tutomvc\theme;
?>
<div class="ContentBlockContainer">
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
			<div class="ContentBlock"<?php echo implode(" ", $attributes); ?>>
				<div class="Wrapper">
					<div class="Inner">
						<?php
							if(isset($backgroundImage)):
						?>
							<div class="BackgroundImage ImagePlaceholder" data-src="<?php echo $backgroundImage[0]; ?>" data-width="<?php echo $backgroundImage[1]; ?>" data-height="<?php echo $backgroundImage[2]; ?>">
							</div>
						<?php
							endif;
						?>
						<div class="TheContent">
							<div class="Inner">
								<?php
									echo $inner;
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php
		}
	?>
</div>
