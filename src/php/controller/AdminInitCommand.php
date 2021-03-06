<?php
namespace tutomvc\theme;
use \tutomvc\ActionCommand;

class AdminInitCommand extends ActionCommand
{
	const NAME = "admin_init";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function execute()
	{
		$this->prepModel();
		$this->prepView();
		$this->prepController();
	}

	function prepModel()
	{
		// Notifications
		if(!AppFacade::isProduction()) $this->getSystem()->notificationCenter->add( __("This is <strong>NOT</strong> production environment."), \tutomvc\Notification::TYPE_UPDATE );
	}

	function prepView()
	{
		add_editor_style( "src/css/wp.editor.css" );
	}

	function prepController()
	{
		$this->getFacade()->controller->registerCommand( new TinymceStartUpFilter() );
	}
}
