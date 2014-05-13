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
		$this->getFacade()->repository = new \tutomvc\GitRepositoryVO( $this->getFacade()->vo->getRoot(), "https://github.com/johannesbuvnas/com.tutomvc.wptheme.git" );

		// Remove post tags
		register_taxonomy('post_tag', array());
		register_taxonomy('press_media', array( "attachment" ));

		// Meta Boxes
		$this->getSystem()->metaCenter->add( new FeaturedMediaMetaBox() );
		$this->getSystem()->metaCenter->add( new ContentBlockMetaBox() );

		// Post types
		$this->getSystem()->postTypeCenter->add( new CustomPostType() );
		remove_post_type_support( "page", "editor" );
		remove_post_type_support( "page", "comments" );
		remove_post_type_support( "post", "editor" );
		remove_post_type_support( "post", "comments" );

		// Menus
		$this->getSystem()->menuCenter->add( new MainMenu() );
		add_theme_support( "menus" );

		// Admin menus
		$this->getSystem()->adminMenuPageCenter->add( new ThemeSettingsAdminMenuPage() );
		$this->getSystem()->settingsCenter->add( new ThemeSettings() );
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
		$this->getFacade()->controller->registerCommand( new UploadThumbnailAjaxCommand() );
		$this->getFacade()->controller->registerCommand( new SavePostActionCommand() );

		// Multisite fixes
		if(is_multisite())
		{
			$this->getFacade()->controller->registerCommand( new FilterAttachmentURLCommand() );
		}
	}
}
