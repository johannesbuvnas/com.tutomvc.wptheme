<?php
namespace tutomvc\theme;
use \tutomvc\FilterCommand;

class TinymceStartUpFilter extends FilterCommand
{
	function __construct()
	{
		parent::__construct( "tiny_mce_before_init" );
	}

	function execute($settings)
	{
		$style_formats = array(
			array
			(
				'title' => "h1",
				"block" => "h1"
			),
			array
			(
				'title' => "h2",
				"block" => "h2"
			),
			array
			(
				'title' => "Paragraph",
				"block" => "p"
			),
			array(
			    'title' => 'Title',
			    'selector' => "p,i,span,a,li",
			    'attributes' => array(
			    	'class' => 'Title'
			    )
			),
			array(
			    'title' => 'Tagline',
			    'selector' => "p,span,a",
			    'attributes' => array(
			    	'class' => 'Tagline'
			    )
			),
			array(
			    'title' => 'Blue Text',
			    'selector' => "p,i,span,a,li,h1,h2,h3,h4,h5,h6",
			    'classes' => "BlueText"
			),
			array(
				'title' => 'White Text',
				'selector' => "p,i,span,a,li,h1,h2,h3,h4,h5,h6",
				'classes' => "WhiteText"
			),
			array(
				'title' => 'Dark Text',
				'selector' => "p,i,span,a,li,h1,h2,h3,h4,h5,h6",
				'classes' => "DarkText"
			),
			array(
			    'title' => 'Button',
			    'selector' => "p,span,a",
			    'attributes' => array(
			    	'class' => 'Button'
			    )
			)
		);

		$settings['style_formats'] = json_encode( $style_formats );

		return $settings;
	}
}
