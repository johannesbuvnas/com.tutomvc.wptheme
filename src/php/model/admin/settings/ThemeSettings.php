<?php
namespace tutomvc\theme;
use \tutomvc\Settings;
use \tutomvc\SettingsField;

class ThemeSettings extends Settings
{
	const NAME = "custom_settings_options";
	const GOOGLE_ANALYTICS_CODE = "custom_settings_google_analytics_code";

	function __construct()
	{
		parent::__construct(
			self::NAME,
			ThemeSettingsAdminMenuPage::NAME,
			""
		);

		$this->addSettingsField( new SettingsField( 
			self::GOOGLE_ANALYTICS_CODE,
			__( "Google Analytics Account ID" ), "",
			SettingsField::TYPE_TEXT,
			array(
				SettingsField::SETTING_ROWS => 5
			)
		) );
	}
}