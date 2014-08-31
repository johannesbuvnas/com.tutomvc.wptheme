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
		load_theme_textdomain( "tutomvc-theme", get_template_directory() . '/languages' );

		$this->getFacade()->repository = new \tutomvc\GitRepositoryVO( $this->getFacade()->vo->getRoot(), AppConstants::REPOSITORY_URL, "v2" );

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
		$this->getSystem()->imageSizeCenter->add( new \tutomvc\ImageSize( AppConstants::IMAGE_SIZE_UNCROPPED_THUMBNAIL, "Uncropped Thumbnail", get_option( "thumbnail_size_w" ), get_option( "thumbnail_size_h" ), FALSE ) );
		$this->getSystem()->imageSizeCenter->add( new \tutomvc\ImageSize( AppConstants::IMAGE_SIZE_HERO_WIDE, __( "Wide", "tutomvc-theme" ), 1600, 800, TRUE ) );

		// $this->getFacade()->memberModule = $this->getFacade()->registerSubFacade( new \tutomvc\modules\member\MemberModule() );
		// $this->getFacade()->metaTagsModule = $this->getFacade()->registerSubFacade( new \tutomvc\modules\metatags\MetaTagsModule() );
		// $this->getFacade()->analyticsModule = $this->getFacade()->registerSubFacade( new \tutomvc\modules\analytics\AnalyticsModule() );

		// Nav menus
		register_nav_menus( array(
			AppConstants::NAV_MENU_NAVIGATION => __( "Navigation", "tutomvc-theme" ),
			AppConstants::NAV_MENU_ADMINISTRATION => __( "Administration", "tutomvc-theme" ),
		) );
	}

	function prepView()
	{
		global $content_width;
		$content_width = 700;

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
