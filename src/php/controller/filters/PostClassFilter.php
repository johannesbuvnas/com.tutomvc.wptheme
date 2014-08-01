<?php
namespace tutomvc\theme;
use \tutomvc\FilterCommand;

class PostClassFilter extends FilterCommand
{
	const NAME = "post_class";

	function __construct()
	{
		parent::__construct(self::NAME, 10, 3);
	}

	function execute()
	{
		$classes = $this->getArg(0);
		$class = $this->getArg(1);
		$postID = $this->getArg( 2 );

		$classes[] = "Card";

		$heroMeta = get_post_meta( $postID, HeroBannerMetaBox::NAME );

		if(count($heroMeta))
		{
			$heroMeta = array_pop($heroMeta);
			if(count($heroMeta[ HeroBannerMetaBox::IMAGES ]))
			{
				$classes[] = "HasHeroBanner";
				$classes[] = "hero-".$heroMeta[ HeroBannerMetaBox::TEMPLATE ];
			}
		}
		else
		{
			$classes[] = "HasNoHeroBanner";
		}

		return $classes;
	}
}