<?php
namespace tutomvc\theme;
use \tutomvc\MetaBox;
use \tutomvc\MetaField;

class FeaturedMediaMetaBox extends MetaBox
{
	const NAME = "featured_media";
	const IMAGE = "image";
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
			self::IMAGE,
			__("Image"),
			NULL,
			MetaField::TYPE_ATTACHMENT,
			array(
				MetaField::SETTING_TITLE => __( "Select Image" ),
				MetaField::SETTING_MAX_CARDINALITY => 1,
				MetaField::SETTING_BUTTON_TITLE => __( "Insert" ),
				MetaField::SETTING_FILTER => array( "image" ),
			)
		) );

		$this->addField( new MetaField(
			self::SCREENSHOT_THUMBNAIL,
			__("Screenshot Thumbnail"),
			__( "This is auto generated." ),
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

		if(!is_array($meta) || !count($meta) || !array_key_exists("url", $meta)) return "";
		else return $meta['url'];
	}
}
