<?php
namespace tutomvc\modules\member;
use \tutomvc\FilterCommand;

class ShowAdminBarFilterCommand extends FilterCommand
{
	function __construct()
	{
		parent::__construct("show_admin_bar");
	}

	function execute()
	{
		return PrivacySettings::isWPAdminAllowed();
	}
}