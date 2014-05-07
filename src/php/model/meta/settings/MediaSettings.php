<?php
namespace tutomvc\theme;
use \tutomvc\Settings;
use \tutomvc\SettingsField;

class MediaSettings extends Settings
{
	const NAME = "media";
	const PRESS_MEDIA = "press_media";

	function __construct()
	{
		parent::__construct( self::NAME, self::NAME );

		$this->addSettingsField( new SettingsField(
			self::PRESS_MEDIA,
			"Press Media Archive",
			NULL,
			SettingsField::TYPE_ATTACHMENT,
			array(
				SettingsField::SETTING_MAX_CARDINALITY => -1,
				SettingsField::SETTING_TITLE => "Select media",
				SettingsField::SETTING_BUTTON_TITLE => "Add",
				SettingsField::SETTING_FILTER => array("image")
			)
		) );
	}
}