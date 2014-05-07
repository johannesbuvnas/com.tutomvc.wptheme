<?php
namespace tutomvc\theme;
use \tutomvc\ActionCommand;
use \tutomvc\ImageSize;

class InitCommand extends ActionCommand
{
	const NAME = "init";

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
		// Remove post tags
		register_taxonomy('post_tag', array());
		register_taxonomy('press_media', array( "attachment" ));

		// Meta Boxes
		$this->getSystem()->metaCenter->add( new FeaturedMediaMetaBox() );
		$this->getSystem()->metaCenter->add( new ContentBlockMetaBox() );

		// Post types
		$this->getSystem()->postTypeCenter->add( new CustomPostType() );
		remove_post_type_support( "page", "editor" );
		remove_post_type_support( "post", "editor" );
		remove_post_type_support( "post", "comments" );
		// Image sizes
		$this->getSystem()->imageSizeCenter->add( new ImageSize( AppConstants::IMAGE_SIZE_COLUMN, __("Column"), 600, 400, TRUE ) );
		$this->getSystem()->imageSizeCenter->add( new ImageSize( AppConstants::IMAGE_SIZE_LOGOTYPE, __("Logotype"), 180, 100 ) );
		// Menus
		$this->getSystem()->menuCenter->add( new MainMenu() );
		add_theme_support( "menus" );

		$this->getSystem()->settingsCenter->add( new GeneralSettings() );
	}

	function prepView()
	{
		$this->getFacade()->view->registerMediator( new AppMediator() );
	}

	function prepController()
	{
		$this->getFacade()->controller->registerCommand( new AdminInitCommand() );
		$this->getFacade()->controller->registerCommand( new AdminMenuActionCommand() );
		$this->getFacade()->controller->registerCommand( new PrePostLinkFilterCommand() );
		$this->getFacade()->controller->registerCommand( new SearchQueryAjaxCommand() );
	}
}
