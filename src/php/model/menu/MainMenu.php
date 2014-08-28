<?php
namespace tutomvc\theme;
use \tutomvc\Menu;

class MainMenu extends Menu
{
	const NAME = "main_menu";

	function __construct()
	{
		parent::__construct( self::NAME, __( "The main menu.", "tutomvc-theme" ) );
	}
}