<?php
namespace tutomvc\theme;
use \tutomvc\Mediator;

class MasonryMediator extends Mediator
{
	const NAME = "components/content/masonry.php";

	const SHORTCODE_POST_TILE = "PostTile";
	const SHORTCODE_PARTNER_TILE = "PartnerTile";
	const SHORTCODE_EVENT_LIST = "EventList";
	const SHORTCODE_PROMOTIONS = "Promotions";
	const SHORTCODE_PRESS_MEDIA = "PressMedia";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
		add_shortcode( self::SHORTCODE_POST_TILE, array( $this, "getPostTile" ) );
		add_shortcode( self::SHORTCODE_PARTNER_TILE, array( $this, "getPartnerTile" ) );
		add_shortcode( self::SHORTCODE_EVENT_LIST, array( $this, "getEventList" ) );
		add_shortcode( self::SHORTCODE_PROMOTIONS, array( $this, "getPromotions" ) );
		add_shortcode( self::SHORTCODE_PRESS_MEDIA, array( $this, "getPressMedia" ) );
	}

	function prepare( $posts, $itemMediator, $classNames = array(), $options = array() )
	{
		array_push($classNames, "Masonry");
		array_push($classNames, "clearfix");

		$this->parse( "posts", $posts );
		$this->parse( "itemMediator", $itemMediator );
		$this->parse( "classNames", $classNames );
		$this->parse( "options", $options );

		return $this;
	}

	function getPressMedia()
	{
		$wpQuery = new \WP_Query(array(
			"post_type" => PressPostType::NAME,
			"nopaging" => TRUE
		));

		$this->prepare( 
			$wpQuery->posts, 
			$this->getFacade()->view->getMediator( FeaturedMediaThumbnailMediator::NAME ), 
			array( "FeaturedMediaThumbnailMasonry" ),
			array(
				"itemSelector" => ".FeaturedMediaThumbnail",
				"gutter" => ".Gutter"
			)
		);

		return $this->getContent();
	}

	function getPromotions()
	{
		$wpQuery = new \WP_Query(array(
			"post_type" => PromotionPostType::NAME,
			"nopaging" => TRUE
		));

		$this->prepare( 
			$wpQuery->posts, 
			$this->getFacade()->view->getMediator( ThumbnailMediator::NAME ), 
			array( "PromotionThumbnailMasonry" ),
			array(
				"itemSelector" => ".PromotionThumbnail",
				"isFitWidth" => 1,
				"gutter" => 20
			)
		);

		return $this->getContent();
	}

	function getPartnerTile()
	{
		$wpQuery = new \WP_Query(array(
			"post_type" => PartnerPostType::NAME,
			"nopaging" => TRUE
		));

		$this->prepare( 
			$wpQuery->posts, 
			$this->getFacade()->view->getMediator( ExcerptMediator::NAME ), 
			array( "PartnerExcerptMasonry" ),
			array(
				"itemSelector" => ".PartnerExcerpt",
				"isFitWidth" => 1
			)
		);

		return $this->getContent();
	}

	function getEventList()
	{
		$wpQuery = new \WP_Query(array(
			"post_type" => EventPostType::NAME,
			"nopaging" => TRUE,
			"meta_value" => date( "Y-m-d" ),
			"meta_compare" => ">="
		));

		$this->parse( "posts", $wpQuery->posts );
		$this->parse( "itemMediator", $this->getFacade()->view->getMediator( ExcerptMediator::NAME ) );
		$this->prepare( 
			$wpQuery->posts, 
			$this->getFacade()->view->getMediator( ExcerptMediator::NAME ), 
			array( "EventExcerptMasonry" ),
			array(
				"itemSelector" => ".EventExcerpt",
				"gutter" => ".Gutter"
			)
		);

		return $this->getContent();
	}

	function getPostTile()
	{
		$args = func_get_arg(0);

		$q = array(
			"post_type" => CustomPostType::NAME,
			"posts_per_page" => 4,
			"paged" => 1
		);

		if(!empty($args) && is_array( $args ))
		{
			if(!empty($args['exclude']))
			{
				$args["post__not_in"] = explode(",", $args['exclude']);
				unset($args['exclude']);
			}

			$q = array_merge( $q, $args );
		}

		$wpQuery = new \WP_Query($q);

		$this->prepare( 
			$wpQuery->posts, 
			$this->getFacade()->view->getMediator( ExcerptMediator::NAME ), 
			array( "PostExcerptMasonry" ),
			array(
				"itemSelector" => ".PostExcerpt",
				"gutter" => ".Gutter"
			)
		);

		return $this->getContent();
	}
}