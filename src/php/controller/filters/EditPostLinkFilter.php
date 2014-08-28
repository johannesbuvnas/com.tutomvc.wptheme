<?php
/**
*	Filter edit_post_link
*/
namespace tutomvc\theme;
use \tutomvc\FilterCommand;

class EditPostLinkFilter extends FilterCommand
{
	const NAME = "edit_post_link";

	function __construct()
	{
		parent::__construct(self::NAME, 10, 3);
	}

	function execute()
	{
		$link = $this->getArg(0);
		$postID = $this->getArg(1);
		$text = $this->getArg(2);

		if ( ! $url = get_edit_post_link( $postID ) )
		{
			return;
		}

		return '<a class="EditPostLink" href="'.$url.'"><span class="genericon-before genericon-edit">'.__( 'Edit', 'tutomvc-theme' ).'</span></a>';
	}
}