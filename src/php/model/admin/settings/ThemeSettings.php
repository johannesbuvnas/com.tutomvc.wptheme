<?php
namespace tutomvc\theme;
use \tutomvc\Settings;
use \tutomvc\SettingsField;

class ThemeSettings extends Settings
{
	const NAME = "custom_settings_options";
	const LINK = "custom_settings_options_link";

	function __construct()
	{
		parent::__construct(
			self::NAME,
			ThemeSettingsAdminMenuPage::NAME,
			"Custom Settings"
		);

		$this->addSettingsField( new SettingsField( 
			self::LINK,
			__( "Link" ), "",
			SettingsField::TYPE_LINK,
			array(
				SettingsField::SETTING_DIVIDER_AFTER => TRUE
			)
		) );
	}
}