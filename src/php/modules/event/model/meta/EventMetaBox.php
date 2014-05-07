<?php
namespace tutomvc\theme;
use \tutomvc\MetaBox;
use \tutomvc\MetaField;
use \tutomvc\MetaCondition;

class EventMetaBox extends MetaBox
{
	const NAME = "event_meta";
	const TIME = "time";
	const TAGLINE = "tagline";
	const TEXT = "text";
	const LOCATION_STREET = "location_street";
	const LOCATION_POSTAL = "location_postal";
	const LOCATION_CITY = "location_city";
	const LOCATION_COUNTRY = "location_country";
	const RSVP = "rsvp";

	function __construct()
	{
		parent::__construct( self::NAME, __( "Event Information" ), array( EventPostType::NAME ), 1, MetaBox::CONTEXT_NORMAL, MetaBox::PRIORITY_HIGH );

		$this->addField( new MetaField(
			self::TIME,
			__("Date and time"),
			NULL,
			MetaField::TYPE_SELECTOR_DATETIME,
			array(
				MetaField::SETTING_FORMAT => "H:i"
			)
		) );

		$this->addField( new MetaField(
			self::TAGLINE,
			__("Tagline"),
			__("Small amount of text that clarify the thought of the event."),
			MetaField::TYPE_TEXTAREA,
			array(
				MetaField::SETTING_ROWS => 3
			)
		) );

		$this->addField( new MetaField(
			self::TEXT,
			__("Text"),
			__("Information about the event."),
			MetaField::TYPE_TEXTAREA_WYSIWYG
		) );


		// LOCATION
		$this->addField( new MetaField(
			self::LOCATION_STREET,
			__("Location: street address"),
			NULL,
			MetaField::TYPE_TEXT,
			array(
				MetaField::SETTING_DIVIDER_BEFORE => TRUE
			)
		) );

		$this->addField( new MetaField(
			self::LOCATION_POSTAL,
			__("Location: postal code"),
			NULL,
			MetaField::TYPE_TEXT
		) );
		$this->addField( new MetaField(
			self::LOCATION_CITY,
			__("Location: city"),
			NULL,
			MetaField::TYPE_TEXT
		) );
		$this->addField( new MetaField(
			self::LOCATION_COUNTRY,
			__("Location: country"),
			NULL,
			MetaField::TYPE_TEXT,
			array(
				MetaField::SETTING_DEFAULT_VALUE => "Sweden",
				MetaField::SETTING_DIVIDER_AFTER => TRUE
			)
		) );

		$this->addField( new MetaField(
			self::RSVP,
			__("RSVP"),
			__("An email address."),
			MetaField::TYPE_TEXT,
			array(
				MetaField::SETTING_DEFAULT_VALUE => "rsvp@" . \tutomvc\AppConstants::DOMAIN
			)
		) );
	}
}