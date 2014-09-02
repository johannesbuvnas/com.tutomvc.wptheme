<?php
namespace tutomvc\theme;
use \tutomvc\MetaBox;
use \tutomvc\MetaField;
use \tutomvc\SingleSelectorMetaField;
use \tutomvc\MetaCondition;

class HeroBannerMetaBox extends MetaBox
{
	const NAME = "tutomvc_hero_banner";
	const IMAGES = "images";
	const TEMPLATE = "template";
	const TEMPLATE_WIDE = "template_wide";
	const TEMPLATE_STRAIGHT_COVER = "template_straight_cover";
	const TEMPLATE_STRAIGHT_FULL = "template_straight_full";
	const TEMPLATE_STRAIGHT_FIT = "template_straight_fit";

	function __construct()
	{
		parent::__construct(
			self::NAME,
			__( "Hero Banner", "tutomvc-theme" ),
			array( "post", "page" ),
			1,
			MetaBox::CONTEXT_NORMAL,
			MetaBox::PRIORITY_HIGH
		);

		$this->addField( new MetaField(
			self::IMAGES,
			__( "Images", "tutomvc-theme" ),
			"",
			MetaField::TYPE_ATTACHMENT,
			array(
				MetaField::SETTING_MAX_CARDINALITY => -1,
				MetaField::SETTING_FILTER => array( "image" )
			)
		) );

		$this->addField( new SingleSelectorMetaField(
			self::TEMPLATE,
			__( "Template", "tutomvc-theme" ),
			"",
			array(
				self::TEMPLATE_WIDE => __( "Wide 2:1 (with controls)", "tutomvc-theme" ),
				self::TEMPLATE_STRAIGHT_COVER => __( "Straight & Cover", "tutomvc-theme" ),
				self::TEMPLATE_STRAIGHT_FULL => __( "Straight & Full", "tutomvc-theme" ),
				self::TEMPLATE_STRAIGHT_FIT => __( "Straight & Fit", "tutomvc-theme" )
			),
			self::TEMPLATE_WIDE
		) );

		// if(!is_admin()) add_filter( "get_post_metadata", array( $this, "filter_get_post_metadata" ), 99, 4 );
	}

	public static function getFeaturedImageID( $postID )
	{
		$attachmentID = get_post_thumbnail_id( $postID );

		if(!$attachmentID)
		{
			$heroMeta = get_post_meta( $postID, HeroBannerMetaBox::NAME );
			if(count($heroMeta))
			{
				$heroMeta = array_pop($heroMeta);
				if(count($heroMeta[ HeroBannerMetaBox::IMAGES ])) $attachmentID = $heroMeta[ HeroBannerMetaBox::IMAGES ][0]['id'];
			}
		}

		return $attachmentID;
	}

	function filter_get_post_metadata( $null, $object_id, $meta_key, $single )
	{
		if($meta_key == "_thumbnail_id")
		{
			$postType = get_post_type( $object_id );
			if(in_array($postType, $this->getSupportedPostTypes()))
			{
				$images = get_post_meta( $object_id, self::constructMetaKey( self::NAME, self::IMAGES ) );
				if(is_array($images) && count($images))
				{
					return $images[0]['id'];
				}
			}
		}

		return NULL;
	}
}
