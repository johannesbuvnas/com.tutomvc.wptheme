<?php
namespace tutomvc\theme;
use \tutomvc\Facade;

class AppFacade extends Facade
{
	const KEY = "tutomvc/theme/facade";
	const VERSION = "1.04";

	static $environment;

	public $memberModule;
	public $repository;

	function __construct()
	{
		parent::__construct( self::KEY );
	}

	function onRegister()
	{
		switch($_SERVER['HTTP_HOST'])
		{
			case "local.tutomvc.com":
			case "192.168.66.196":

				self::$environment = AppConstants::ENVIRONMENT_STAGE;
				error_reporting( E_ERROR | E_WARNING | E_PARSE | E_NOTICE );

			break;
			default:

				self::$environment = AppConstants::ENVIRONMENT_PRODUCTION;
				error_reporting( E_ERROR );

			break;
		}

		$this->memberModule = $this->registerSubFacade( new \tutomvc\modules\member\MemberModule() );
		
		$this->controller->registerCommand( new InitCommand() );
	}
}
