<?php namespace tutomvc\theme;
use \Walker;
use \Walker_Nav_Menu;

class NavMenuWalker extends Walker_Nav_Menu
{
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu nav nav-tabs nav-stacked\">\n";
	}
}