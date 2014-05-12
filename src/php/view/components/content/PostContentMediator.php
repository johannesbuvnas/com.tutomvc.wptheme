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
	}

	/* SET AND GET */
	function getContent()
	{
		if(!is_user_logged_in())
		{
			return $this->getFacade()->memberModule->view->getMediator( \tutomvc\modules\member\LoginContentMediator::NAME )
					->getContent();
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
