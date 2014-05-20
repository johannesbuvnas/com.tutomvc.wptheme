<?php
namespace tutomvc\theme;
use \tutomvc\Facade;

class AppFacade extends Facade
{
	const KEY = "tutomvc/theme/facade";
	const VERSION = "1.044";

	static $environment;
	static $isPreview = FALSE;

	public $memberModule;
	public $metaTagsModule;
	public $repository;

	function __construct()
	{
		parent::__construct( self::KEY );
	}

	function onRegister()
	{
		self::$isPreview = array_key_exists("preview", $_GET);
		
		switch($_SERVER['HTTP_HOST'])
		{
			case "local.tutomvc.com":

				self::$environment = AppConstants::ENVIRONMENT_STAGE;
				error_reporting( E_ERROR | E_WARNING | E_PARSE | E_NOTICE );

			break;
			default:

				self::$environment = AppConstants::ENVIRONMENT_PRODUCTION;
				error_reporting( E_ERROR );

			break;
		}

		$this->memberModule = $this->registerSubFacade( new \tutomvc\modules\member\MemberModule() );
		$this->metaTagsModule = $this->registerSubFacade( new \tutomvc\modules\metatags\MetaTagsModule() );
		
		$this->controller->registerCommand( new InitCommand() );
	}
}
