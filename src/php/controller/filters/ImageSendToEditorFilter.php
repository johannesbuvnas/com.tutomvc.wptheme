<?php
namespace tutomvc\theme;
use \tutomvc\FilterCommand;

class ImageSendToEditorFilter extends FilterCommand
{
	const NAME = "image_send_to_editor";

	function __construct()
	{
		parent::__construct(self::NAME, 0, 8);
	}

	function execute($html, $id, $caption, $title, $align, $url, $size, $alt)
	{
		$videoLinkageMeta = (array)get_post_meta( $id, ImageVideoLinkageMetaBox::NAME );
		if(count($videoLinkageMeta))
		{
			$videoLinkageMeta = array_pop($videoLinkageMeta);
			$videoURL = $videoLinkageMeta[ $videoLinkageMeta[ ImageVideoLinkageMetaBox::TYPE ] ];
			if(is_array($videoURL))
			{
				// Attachment is the type
				$videoURL = array_pop($videoURL);
				$videoURL = $videoURL['url'];
			}
			// TODO: Apply class name
			list( $img_src, $width, $height ) = image_downsize($id, $size);
			$hwstring = image_hwstring($width, $height);

			$title = $title ? 'title="' . esc_attr( $title ) . '" ' : '';

			$class = 'align' . esc_attr($align) .' size-' . esc_attr($size) . ' wp-image-' . $id;
			$class = apply_filters( 'get_image_tag_class', $class, $id, $align, $size );

			$html = '
				<a href="'.$videoURL.'" target="_blank" class="InlineVideoLinkage" data-video-linkage="'.json_encode($videoLinkageMeta).'">
					<img src="' . esc_attr($img_src) . '" alt="' . esc_attr($alt) . '" ' . $title . $hwstring . 'class="' . $class . '" />
					<div class="genericon genericon-play ShadowBox"></div>
				</a>';

		}

		return $align == "none" ? "<figure class='AddedMedia size-".$size."'>$html</figure>" : $html;
	}
}