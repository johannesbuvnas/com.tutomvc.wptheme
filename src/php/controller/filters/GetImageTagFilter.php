<?php
namespace tutomvc\theme;
use \tutomvc\FilterCommand;

class GetImageTagFilter extends FilterCommand
{
	const NAME = "get_image_tag";

	function __construct()
	{
		parent::__construct(self::NAME, 0, 6);
	}

	function execute($html, $id, $alt, $title, $align, $size)
	{
		return $html;
	}
}