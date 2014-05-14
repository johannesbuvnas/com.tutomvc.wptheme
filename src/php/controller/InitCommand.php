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
		$this->getFacade()->repository = new \tutomvc\GitRepositoryVO( $this->getFacade()->vo->getRoot(), AppConstants::REPOSITORY_URL );

		// Meta Boxes
		$this->getSystem()->metaCenter->add( new FeaturedMediaMetaBox() );
		$this->getSystem()->metaCenter->add( new ContentBlockMetaBox() );

		// Post types
		$this->getSystem()->postTypeCenter->add( new DefaultPostType() );
		remove_post_type_support( DefaultPostType::NAME, "editor" );
		$this->getSystem()->postTypeCenter->add( new DefaultPagePostType() );
		remove_post_type_support( DefaultPagePostType::NAME, "comments" );
		remove_post_type_support( DefaultPagePostType::NAME, "editor" );

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
		$this->getFacade()->controller->registerCommand( new UploadThumbnailAjaxCommand() );
		$this->getFacade()->controller->registerCommand( new SavePostActionCommand() );

		// Multisite fixes
		if(is_multisite())
		{
			$this->getFacade()->controller->registerCommand( new FilterAttachmentURLCommand() );
		}
	}
}
