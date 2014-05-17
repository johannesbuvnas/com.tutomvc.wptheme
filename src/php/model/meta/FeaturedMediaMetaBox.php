<?php
namespace tutomvc\theme;
use \tutomvc\MetaBox;
use \tutomvc\MetaField;

class FeaturedMediaMetaBox extends MetaBox
{
	const NAME = "featured_media";
	const SCREENSHOT_THUMBNAIL = "screenshot_thumbnail";

	function __construct()
	{
		parent::__construct(
			self::NAME,
			__( "Featured Media" ),
			array( "post", "page" ),
			1,
			MetaBox::CONTEXT_SIDE,
			MetaBox::PRIORITY_DEFAULT
		);

		$this->addField( new MetaField(
			self::SCREENSHOT_THUMBNAIL,
			__("Screenshot Thumbnail"),
			__( "This is auto generated. Do not edit." ),
			MetaField::TYPE_ATTACHMENT,
			array(
				MetaField::SETTING_MAX_CARDINALITY => 1
			)
		) );

		$this->setMinCardinality( 1 );
	}

	public static function deleteScreenshotThumbnail( $postID )
	{
		$metaKey = self::constructMetaKey( self::NAME, self::SCREENSHOT_THUMBNAIL );
		$meta = get_post_meta( $postID, $metaKey );
		$meta = array_pop($meta);

		if(!is_array($meta) || !count($meta) || !array_key_exists("id", $meta)) return FALSE;

		delete_post_meta( $postID, $metaKey );

		return wp_delete_attachment( $meta['id'] );
	}

	public static function setScreenshotThumbnail( $postID, $attachmentID )
	{
		$metaKey = self::constructMetaKey( self::NAME, self::SCREENSHOT_THUMBNAIL );
		return update_post_meta( $postID, $metaKey, $attachmentID );
	}
	public static function getScreenshotThumbnailURL( $postID )
	{
		$metaKey = self::constructMetaKey( self::NAME, self::SCREENSHOT_THUMBNAIL );
		$meta = get_post_meta( $postID, $metaKey );
		$meta = array_pop($meta);

		if(!is_array($meta) || !count($meta) || !array_key_exists("id", $meta)) return "";
		
		$src = wp_get_attachment_image_src( $meta['id'], AppConstants::IMAGE_SIZE_UNCROPPED_THUMBNAIL );

		return $src[0];
	}
}
