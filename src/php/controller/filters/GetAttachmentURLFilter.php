<?php
namespace tutomvc\theme;
use \tutomvc\FilterCommand;

class GetAttachmentURLFilter extends FilterCommand
{
	const NAME = "wp_get_attachment_url";

	function __construct()
	{
		parent::__construct(self::NAME, 0, 6);
	}

	function execute($url, $postID)
	{
		$videoLinkageMeta = (array)get_post_meta( $postID, ImageVideoLinkageMetaBox::NAME );
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
			
			return $videoURL;
		}

		return $url;
	}
}