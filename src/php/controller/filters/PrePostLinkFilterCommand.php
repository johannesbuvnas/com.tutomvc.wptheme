<?php
namespace tutomvc\theme;
use \tutomvc\FilterCommand;

class PrePostLinkFilterCommand extends FilterCommand
{
	const NAME = "post_type_link";

	function __construct()
	{
		parent::__construct( self::NAME, 2 );
	}

	function execute()
	{
		$permalink = $this->getArg(0);
		$post = $this->getArg(1);

		switch($post->post_type)
		{
			case PartnerPostType::NAME:

			return home_url( PartnerPostType::NAME );

			break;
		}

		return $permalink;
	}
}