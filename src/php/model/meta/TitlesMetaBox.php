<?php
namespace tutomvc\theme;
use \tutomvc\MetaBox;
use \tutomvc\MetaField;
use \tutomvc\SingleSelectorMetaField;
use \tutomvc\TextAreaMetaField;
use \tutomvc\MetaCondition;

class TitlesMetaBox extends MetaBox
{
	const NAME = "tutomvc_titles";
	const SUBTITLE = "subtitle";

	function __construct()
	{
		parent::__construct(
			self::NAME,
			__( "Titles" ),
			array( "post", "page" ),
			1,
			MetaBox::CONTEXT_SIDE,
			MetaBox::PRIORITY_HIGH
		);

		$this->setMinCardinality( 1 );

		$this->addField( new TextAreaMetaField(
			self::SUBTITLE,
			__("Subtitle"),
			"",
			5
		) );
	}
}
