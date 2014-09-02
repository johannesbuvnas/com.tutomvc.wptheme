<?php namespace tutomvc\theme;
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
		add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
		load_theme_textdomain( "tutomvc-theme", $this->getFacade()->vo->getRoot( "languages" ) );

		// Meta Boxes
		$this->getSystem()->metaCenter->add( new HeroBannerMetaBox() );
		$this->getSystem()->metaCenter->add( new TitlesMetaBox() );
		// $this->getSystem()->metaCenter->add( new ImageVideoLinkageMetaBox() );

		// Post types
		$this->getSystem()->postTypeCenter->add( new DefaultPostType() );
		$this->getSystem()->postTypeCenter->add( new DefaultAttachmentPostType() );
		$this->getSystem()->postTypeCenter->add( new DefaultPagePostType() );

		// Admin menus
		$this->getSystem()->adminMenuPageCenter->add( new ThemeSettingsAdminMenuPage() );
		$this->getSystem()->settingsCenter->add( new ThemeSettings() );

		// Image sizes
		if(get_option( "thumbnail_size_w" ) != 150) update_option( "thumbnail_size_w", 150 );
		if(get_option( "thumbnail_size_h" ) != 150) update_option( "thumbnail_size_h", 150 );
		if(intval(get_option( "thumbnail_crop" )) < 1) update_option( "thumbnail_crop", 1 );
		set_post_thumbnail_size( 672, 372, true );
		$this->getSystem()->imageSizeCenter->add( new \tutomvc\ImageSize( AppFacade::IMAGE_SIZE_HERO_WIDE, __( "Wide", "tutomvc-theme" ), 1600, 800, TRUE ) );

		// $this->getFacade()->memberModule = $this->getFacade()->registerSubFacade( new \tutomvc\modules\member\MemberModule() );
		// $this->getFacade()->metaTagsModule = $this->getFacade()->registerSubFacade( new \tutomvc\modules\metatags\MetaTagsModule() );
		// $this->getFacade()->analyticsModule = $this->getFacade()->registerSubFacade( new \tutomvc\modules\analytics\AnalyticsModule() );

		// Nav menus
		register_nav_menus( array(
			AppFacade::NAV_MENU_NAVIGATION => __( "Navigation", "tutomvc-theme" ),
			AppFacade::NAV_MENU_ADMINISTRATION => __( "Administration", "tutomvc-theme" ),
		) );
	}

	function prepView()
	{
		global $content_width;
		$content_width = 768;

		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );
		
		$this->getFacade()->view->registerMediator( new AppMediator() );
		$this->getFacade()->view->registerMediator( new TagCloudWidgetMediator() );
		$this->getFacade()->view->registerMediator( new TermCardMediator() );
		$this->getFacade()->view->registerMediator( new AuthorCardMediator() );
		$this->getFacade()->view->registerMediator( new CommentAuthorCardMediator() );

		if(!AppFacade::isProduction() && intval(get_option("blog_public")) > 0) update_option( "blog_public", 0 );
	}

	function prepController()
	{
		add_filter('show_admin_bar', '__return_false');
		$this->getFacade()->controller->registerCommand( new AdminInitCommand() );
		$this->getFacade()->controller->registerCommand( new UploadThumbnailAjaxCommand() );
		$this->getFacade()->controller->registerCommand( new WPEnqueueScriptsCommand() );
		$this->getFacade()->controller->registerCommand( new PostClassFilter() );
		$this->getFacade()->controller->registerCommand( new TheContentFilter() );
		$this->getFacade()->controller->registerCommand( new EditPostLinkFilter() );
		$this->getFacade()->controller->registerCommand( new NavMenuLinkAttrFilter() );
		$this->getFacade()->controller->registerCommand( new OEMBEDHTMLFilter() );

		// Multisite fixes
		if(is_multisite())
		{
			$this->getFacade()->controller->registerCommand( new FilterAttachmentURLCommand() );
		}
	}
}
