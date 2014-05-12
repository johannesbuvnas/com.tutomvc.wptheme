<?php
namespace tutomvc\theme;
use \tutomvc\Settings;
use \tutomvc\SettingsField;

class ThemeSettings extends Settings
{
	const NAME = "custom_settings_options";
	const IS_PROTECTED = "custom_settings_is_protected";
	const GOOGLE_ANALYTICS_CODE = "custom_settings_google_analytics_code";

	function __construct()
	{
		parent::__construct(
			self::NAME,
			ThemeSettingsAdminMenuPage::NAME,
			""
		);

		$this->addSettingsField( new SettingsField( 
			self::IS_PROTECTED,
			__( "Require User Login / Password Protect" ), "You can password protect the whole site.",
			SettingsField::TYPE_SELECTOR_SINGLE,
			array(
				SettingsField::SETTING_OPTIONS => array(
					"true" => "Yes",
					"false" => "No"
				),
				SettingsField::SETTING_DEFAULT_VALUE => "false"
			)
		) );

		$this->addSettingsField( new SettingsField( 
			self::GOOGLE_ANALYTICS_CODE,
			__( "Google Analytics Code Snippet" ), "",
			SettingsField::TYPE_TEXTAREA,
			array(
				SettingsField::SETTING_ROWS => 5
			)
		) );
	}
}