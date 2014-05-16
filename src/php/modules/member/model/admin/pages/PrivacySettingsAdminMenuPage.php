<?php
namespace tutomvc\modules\member;
use \tutomvc\AdminMenuSettingsPage;

class PrivacySettingsAdminMenuPage extends AdminMenuSettingsPage
{
	const NAME = "custom_privacy_settings";

	function __construct()
	{
		parent::__construct(
			__("Privacy Settings"),
			__("Privacy Settings"),
			"edit_plugins",
			self::NAME,
			NULL,
			NULL
		);

		$this->setType( AdminMenuSettingsPage::TYPE_THEME );
	}

	public function onLoad()
	{
	}
}