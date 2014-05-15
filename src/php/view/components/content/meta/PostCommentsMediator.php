<?php
namespace tutomvc\theme;
use \tutomvc\Mediator;

class PostCommentsMediator extends Mediator
{
	const NAME = "components/content/meta/comments.php";

	protected $_post;

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
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
