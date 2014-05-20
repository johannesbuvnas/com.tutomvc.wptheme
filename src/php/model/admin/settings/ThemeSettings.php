<?php
namespace tutomvc\theme;
use \tutomvc\Settings;
use \tutomvc\SettingsField;

class ThemeSettings extends Settings
{
	const NAME = "custom_settings_options";

	function __construct()
	{
		parent::__construct(
			self::NAME,
			ThemeSettingsAdminMenuPage::NAME,
			""
		);
	}
}