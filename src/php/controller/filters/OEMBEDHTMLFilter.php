<?php namespace tutomvc\theme;
/**
*	Alter the outputted oembed HTML.
*/
use \tutomvc\FilterCommand;

class OEMBEDHTMLFilter extends FilterCommand
{
	const NAME = "embed_oembed_html";

	function __construct()
	{
		parent::__construct( self::NAME, 10, 4 );
	}

	function execute($html, $url, $attr, $post_ID )
	{
		return '<div class="OEMBED"><div class="Inner">'.$html.'</div></div>';
	}
}