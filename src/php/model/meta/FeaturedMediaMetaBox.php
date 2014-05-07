<?php
namespace tutomvc\theme;
use \tutomvc\MetaBox;
use \tutomvc\MetaField;

class FeaturedMediaMetaBox extends MetaBox
{
	const NAME = "featured_media";
	const IMAGE = "image";

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
	}
}
