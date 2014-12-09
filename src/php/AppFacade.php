<?php
	namespace tutomvc\theme;

	use \tutomvc\Facade;

	class AppFacade extends Facade
	{
		const KEY     = "tutomvc/theme/facade";
		const VERSION = "1.0.03";

		const GIT_REPOSITORY_URL     = "https://github.com/johannesbuvnas/com.tutomvc.wptheme.git";
		const GIT_REPOSITORY_BRANCH  = "v2";
		const NONCE_NAME             = "tutomvc/theme/ajax/nonce";
		const ENVIRONMENT_STAGE      = "tutomvc/theme/stage";
		const ENVIRONMENT_PRODUCTION = "tutomvc/theme/production";
		const IMAGE_SIZE_HERO_WIDE   = "tutomvc_hero_wide";
		const SCRIPT_JS              = "tutomvc/theme/script/js";
		const SCRIPT_JS_REQUIRE      = "tutomvc/theme/script/js/require";
		const STYLE_CSS              = "tutomvc/theme/style/css";
		const SIDEBAR_SEARCH         = "sidebar-search";
		const NAV_SITE_NAVIGATION    = "nav-site-navigation";

		private static $_environmentsMap;
		static         $isPreview = FALSE;

		public $analyticsModule;
		public $termPageModule;
		public $memberModule;
		public $repository;

		function __construct()
		{
			parent::__construct( self::KEY );

			self::$_environmentsMap = array(
				self::ENVIRONMENT_STAGE      => array(),
				self::ENVIRONMENT_PRODUCTION => array()
			);

			$this->addEnvironment( $_SERVER[ 'HTTP_HOST' ], self::ENVIRONMENT_PRODUCTION );
		}

		function onRegister()
		{
			$this->repository = new \tutomvc\GitRepositoryVO( $this->vo->getRoot(), self::GIT_REPOSITORY_URL, self::GIT_REPOSITORY_BRANCH );

			$this->termPageModule  = \tutomvc\modules\termpage\TermPageModule::getInstance();
			$this->analyticsModule = \tutomvc\modules\analytics\AnalyticsModule::getInstance();
			$this->memberModule    = \tutomvc\modules\privacy\PrivacyModule::getInstance();

			$this->controller->registerCommand( new InitCommand() );
			$this->controller->registerCommand( new WidgetsInitCommand() );
		}

		/* ENVIRONMENT */
		public static function addEnvironment( $environmentDomain, $type = self::ENVIRONMENT_STAGE )
		{
			self::$_environmentsMap[ $type ][ ] = $environmentDomain;

			switch ( self::isProduction() )
			{
				case FALSE:

					error_reporting( E_ALL );

					break;
				default:

					error_reporting( E_ERROR );

					break;
			}
		}

		public static function isProduction()
		{
			return !in_array( $_SERVER[ 'HTTP_HOST' ], self::$_environmentsMap[ self::ENVIRONMENT_STAGE ] );
		}
	}
