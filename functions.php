<?php
namespace tutomvc\theme;
function init()
{
	global $themeFacade;
	require_once "vendor/autoload.php";
	$themeFacade = \tutomvc\TutoMVC::startup( 
		"tutomvc\\theme\\AppFacade", // Facade class name reference
		"/src/php/view/components" // Templates directory for \\tutomvc\\Mediator
	);
	
	// Add staging environment
//	$themeFacade->addEnvironment( "local.tutomvc.com" );
}
if(class_exists("tutomvc\\TutoMVC")) init();
else add_action( "tutomvc/action/startup", "tutomvc\\theme\\init" );