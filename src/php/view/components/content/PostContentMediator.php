<?php
namespace tutomvc\theme;
use \tutomvc\Mediator;

class PostContentMediator extends Mediator
{
	const NAME = "components/content/post.php";

	protected $_post;

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
		$this->getFacade()->view->registerMediator( new ContentBlockMediator() );
		$this->getFacade()->view->registerMediator( new MasonryMediator() );
		$this->getFacade()->view->registerMediator( new PostMetaMediator() );
	}

	/* SET AND GET */
	function getContent()
	{
		if(filter_var( get_option(ThemeSettings::IS_PROTECTED), FILTER_VALIDATE_BOOLEAN ) && !is_user_logged_in())
		{
			return $this->getFacade()->memberModule->view->getMediator( \tutomvc\modules\member\LoginContentMediator::NAME )
					->getContent();
			exit;
		}
		
		$this->parse( "post", $this->getPost() );

		return parent::getContent();
	}

	function setPost($post)
	{
		$this->_post = $post;

		return $this;
	}
	function getPost()
	{
		global $post;

		return isset($this->_post) ? $this->_post : $post;
	}
}
