<?php
namespace tutomvc\theme;
use \tutomvc\MetaBox;
use \tutomvc\MetaField;
use \tutomvc\SingleSelectorMetaField;
use \tutomvc\TextAreaMetaField;
use \tutomvc\AttachmentMetaField;
use \tutomvc\MetaCondition;

class ImageVideoLinkageMetaBox extends MetaBox
{
	const NAME = "tutomvc_image_video_linkage";
	const TYPE = "type";
	const TYPE_URL = "type_url";
	const TYPE_FILE = "type_file";

	function __construct()
	{
		parent::__construct(
			self::NAME,
			__( "Video Linkage" ),
			array( "attachment" ),
			1,
			MetaBox::CONTEXT_SIDE,
			MetaBox::PRIORITY_CORE
		);

		$this->addField( new SingleSelectorMetaField(
			self::TYPE,
			__( "Type" ),
			"",
			array(
				self::TYPE_URL => __( "URL" ),
				self::TYPE_FILE => __( "File" ),
			),
			self::TYPE_URL
		) );

		$this->addField( new MetaField(
			self::TYPE_URL,
			__( "Video URL" ),
			"YouTube or Vimeo",
			MetaField::TYPE_TEXT,
			NULL,
			array( 
				new MetaCondition( self::NAME, self::TYPE, self::TYPE_URL, MetaCondition::CALLBACK_SHOW, MetaCondition::CALLBACK_HIDE )
			)
		) );

		$this->addField( new AttachmentMetaField(
			self::TYPE_FILE,
			__( "Video File(s)" ),
			"",
			-1,
			array("video"),
			__( "Select" ),
			array( 
				new MetaCondition( self::NAME, self::TYPE, self::TYPE_FILE, MetaCondition::CALLBACK_SHOW, MetaCondition::CALLBACK_HIDE )
			)
		) );
	}

	public function filterWPAdminOutput( $output, $postID )
	{
		$post = get_post( $postID );
		return strpos($post->post_mime_type, "image") === FALSE ? '<style>#'.self::NAME.'{display:none;}</style>' : $output;
	}

	public static function hasVideoLinkage( $objectID )
	{
		if(get_post_type( $objectID ) == "attachment" && is_int(strpos( get_post_mime_type( $objectID ), "image")))
		{
			$videoLinkageMeta = (array)get_post_meta( $objectID, ImageVideoLinkageMetaBox::NAME );
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

				return filter_var( $videoURL, FILTER_VALIDATE_URL );
			}
		}

		return FALSE;
	}
}
