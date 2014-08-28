<?php
/**
*	Filter edit_post_link
*/
namespace tutomvc\theme;
use \tutomvc\FilterCommand;

class NavMenuLinkAttrFilter extends FilterCommand
{
	const NAME = "nav_menu_css_class";

	function __construct()
	{
		parent::__construct(self::NAME, 10, 3);
	}

	function execute()
	{
		$classes = $this->getArg(0);
		$item = $this->getArg(1);
		$args = $this->getArg(2);

		if(preg_grep('/current.*/', $classes)) $classes['active'] = "active";

		return $classes;
	}
}