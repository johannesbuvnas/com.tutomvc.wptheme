<?php
namespace tutomvc\theme;
use \tutomvc\AdminMenuSettingsPage;

class ThemeSettingsAdminMenuPage extends AdminMenuSettingsPage
{
	const NAME = "custom_settings";

	function __construct()
	{
		parent::__construct(
			"Custom Settings",
			"Custom Settings",
			"edit_plugins",
			self::NAME,
			NULL,
			NULL
		);

		$this->setType( AdminMenuSettingsPage::TYPE_THEME );
	}
}