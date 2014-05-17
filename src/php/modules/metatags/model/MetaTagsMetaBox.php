<?php
namespace tutomvc\modules\metatags;
use \tutomvc\MetaBox;
use \tutomvc\MetaField;
use \tutomvc\FilterCommand;

class MetaTagsMetaBox extends MetaBox
{
	const NAME = "custom_meta_tags_settings";
	const IMAGE = "thumbnail";
	const DESCRIPTION = "description";
	const FILTER_DESCRIPTION = "tutomvc/modules/metatags/filter/description";
	const FILTER_IMAGE = "tutomvc/modules/metatags/filter/image";

	function __construct()
	{
		parent::__construct( 
			self::NAME, 
			__( "Custom Meta Tags (for sharing on Facebook etc.)" ), 
			array( "page", "post" ),
			1,
			MetaBox::CONTEXT_NORMAL,
			MetaBox::PRIORITY_HIGH
			);

		$this->addField(new MetaField(
				self::IMAGE,
				__( "Featured Image" ),
				NULL,
				MetaField::TYPE_ATTACHMENT,
				array(
					MetaField::SETTING_MAX_CARDINALITY => 1
				)
			) );

		$this->addField(new MetaField(
				self::DESCRIPTION,
				__( "Description" ),
				__( "A short version in text of this content" ),
				MetaField::TYPE_TEXTAREA,
				array(
					MetaField::SETTING_ROWS => 5
				)
			) );
	}

	public static function getTheDescription( $id )
	{
		return get_post_meta( $id, self::constructMetaKey( self::NAME, self::DESCRIPTION, TRUE ) );
	}
}