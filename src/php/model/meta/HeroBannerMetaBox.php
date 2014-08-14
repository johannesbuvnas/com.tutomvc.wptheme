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
			__( "Hero Banner" ),
			array( "post", "page" ),
			1,
			MetaBox::CONTEXT_NORMAL,
			MetaBox::PRIORITY_HIGH
		);

		$this->addField( new MetaField(
			self::IMAGES,
			__("Images"),
			"",
			MetaField::TYPE_ATTACHMENT,
			array(
				MetaField::SETTING_MAX_CARDINALITY => -1,
				MetaField::SETTING_FILTER => array( "image" )
			)
		) );

		$this->addField( new SingleSelectorMetaField(
			self::TEMPLATE,
			__("Template"),
			"",
			array(
				self::TEMPLATE_WIDE => __( "Wide 2:1 (with controls)" ),
				self::TEMPLATE_STRAIGHT_COVER => __( "Straight & Cover" ),
				self::TEMPLATE_STRAIGHT_FULL => __( "Straight & Full" ),
				self::TEMPLATE_STRAIGHT_FIT => __( "Straight & Fit" )
			),
			self::TEMPLATE_WIDE
		) );

		add_filter( "get_post_metadata", array( $this, "filter_get_post_metadata" ), 15, 4 );
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
