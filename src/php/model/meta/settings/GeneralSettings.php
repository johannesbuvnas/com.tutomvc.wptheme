<?php
namespace tutomvc\theme;
use \tutomvc\Settings;
use \tutomvc\SettingsField;

class GeneralSettings extends Settings
{
	const NAME = "general";
	const TWITTER_ACCOUNT = "twitter_account";
	const FACEBOOK_PAGE_ID = "facebook_page_id";
	const FOOTER_CONTENT = "footer_content";

	function __construct()
	{
		parent::__construct( self::NAME, self::NAME );

		$this->addSettingsField( new SettingsField(
			self::TWITTER_ACCOUNT,
			"Twitter Account"
		) );

		$this->addSettingsField( new SettingsField(
			self::FACEBOOK_PAGE_ID,
			"Facebook Page ID"
		) );

		$this->addSettingsField( new SettingsField(
			self::FOOTER_CONTENT,
			"Footer content",
			"",
			SettingsField::TYPE_TEXTAREA_WYSIWYG
		) );
	}
}