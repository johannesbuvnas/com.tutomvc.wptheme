<?php
namespace tutomvc\theme;
use \tutomvc\ActionCommand;

class AdminMenuActionCommand extends ActionCommand
{
	const NAME = "admin_menu";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function execute()
	{
		remove_menu_page( "edit-comments.php" );
	}
}