<?php
namespace tutomvc\theme;
use \tutomvc\Facade;

class EventModule extends Facade
{
	const KEY = "eventmodule";

	function __construct()
	{
		parent::__construct( self::KEY );
	}

	function onRegister()
	{
		$this->prepModel();
		$this->prepView();
		$this->prepController();
	}

	function prepModel()
	{
		// Meta
		$this->getSystem()->metaCenter->add( new EventMetaBox() );
		// Post types
		$this->getSystem()->postTypeCenter->add( new EventPostType() );
	}

	function prepView()
	{
	}

	function prepController()
	{

	}
}