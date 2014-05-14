<?php
namespace tutomvc\theme;
use \tutomvc\MetaBox;
use \tutomvc\MetaField;
use \tutomvc\MetaCondition;

class ContentBlockMetaBox extends MetaBox
{
	const NAME = "custom_content";
	const BACKGROUND_IMAGE = "background_image";
	const TYPE = "content_type";
	const TYPE_ONE_COLUMN = "content_type_one_column";
	const TYPE_TWO_COLUMN = "content_type_two_column";
	const EDITOR = "editor";
	const EDITOR_SECOND = "editor_second";
	const LINK = "link";
	const ALIGN = "align";
	const ALIGN_VERTICAL_CENTER = "align_vertical_center";

	function __construct()
	{
		parent::__construct( self::NAME, __( "Content" ), array( DefaultPagePostType::NAME, DefaultPostType::NAME ), -1, MetaBox::CONTEXT_NORMAL, MetaBox::PRIORITY_CORE );

		$this->addField( new MetaField( self::TYPE, __( "Type" ), "", MetaField::TYPE_SELECTOR_SINGLE, array(
				MetaField::SETTING_OPTIONS => array(
					self::TYPE_ONE_COLUMN => __( "One column" ),
					self::TYPE_TWO_COLUMN => __( "Two columns" ),
				),
				MetaField::SETTING_DEFAULT_VALUE => self::TYPE_ONE_COLUMN
			) ) );

		$this->addField( new MetaField( self::EDITOR, __( "Content" ), "", MetaField::TYPE_TEXTAREA_WYSIWYG ) );
		$this->addField( new MetaField(
				self::EDITOR_SECOND,
				__( "Content" ), "",
				MetaField::TYPE_TEXTAREA_WYSIWYG,
				NULL,
				array(
					new MetaCondition( self::NAME, self::TYPE, self::TYPE_TWO_COLUMN, MetaCondition::CALLBACK_SHOW, MetaCondition::CALLBACK_HIDE )
				)
			)
		);

		$this->addField( new MetaField( self::ALIGN, __( "Align" ), "", MetaField::TYPE_SELECTOR_SINGLE, array(
				MetaField::SETTING_OPTIONS => array(
					"default" => __( "Default" ),
					self::ALIGN_VERTICAL_CENTER => __( "Vertical Center" ),
				),
				MetaField::SETTING_DEFAULT_VALUE => "default"
			) ) );

		$this->addField( new MetaField( self::BACKGROUND_IMAGE, __( "Background Image" ), "", MetaField::TYPE_ATTACHMENT, array(
				MetaField::SETTING_MAX_CARDINALITY => 1
			) ) );
		$this->addField( new MetaField(
				self::LINK,
				__( "Link" ), "",
				MetaField::TYPE_LINK
			)
		);

		$this->setMinCardinality( 1 );
	}
}
