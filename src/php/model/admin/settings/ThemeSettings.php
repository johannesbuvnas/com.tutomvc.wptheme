<?php namespace tutomvc\theme;
use \tutomvc\Settings;
use \tutomvc\SettingsField;

/**
*	Create custom options for this theme.
*/
class ThemeSettings extends Settings
{
	const NAME = "tutomvc_theme_settings_options";

	function __construct()
	{
		parent::__construct(
			self::NAME,
			ThemeSettingsAdminMenuPage::NAME,
			""
		);
	}
}