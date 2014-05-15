<?php
namespace tutomvc\theme;
use \tutomvc\Mediator;

class PostMetaMediator extends Mediator
{
	const NAME = "components/content/meta/meta.php";

	protected $_post;

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
		$this->getFacade()->view->registerMediator( new PostCommentsMediator() );
	}

	/* SET AND GET */
	function getContent()
	{
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
