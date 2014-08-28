<?php
namespace tutomvc\theme;
use \tutomvc\Facade;

class AppFacade extends Facade
{
	const KEY = "tutomvc/theme/facade";
	const VERSION = "1.044";

	private static $_environmentsMap;
	static $isPreview = FALSE;

	public $memberModule;
	public $metaTagsModule;
	public $analyticsModule;
	public $repository;

	function __construct()
	{
		parent::__construct( self::KEY );

		self::$_environmentsMap = array(
			AppConstants::ENVIRONMENT_STAGE => array(),
			AppConstants::ENVIRONMENT_PRODUCTION => array()
		);
	}

	function onRegister()
	{	
		self::$isPreview = array_key_exists( "preview", $_GET );
		
		$this->controller->registerCommand( new InitCommand() );
		$this->controller->registerCommand( new WidgetsInitCommand() );
	}

	/* ENVIRONMENT */
	public static function addEnvironment( $environmentDomain, $type = AppConstants::ENVIRONMENT_STAGE )
	{
		self::$_environmentsMap[ $type ][] = $environmentDomain;

		switch(self::isProduction())
		{
			case FALSE:

				error_reporting( E_ALL );

			break;
			default:

				error_reporting( E_ERROR );

			break;
		}
	}
	public function isProduction()
	{
		return !in_array( $_SERVER['HTTP_HOST'], self::$_environmentsMap[ AppConstants::ENVIRONMENT_STAGE ] );
	}
}
