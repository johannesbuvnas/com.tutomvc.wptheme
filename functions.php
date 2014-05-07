<?php
namespace tutomvc;
global $themeFacade;
if(class_exists("\\tutomvc\TutoMVC"))
{
	$themeFacade = \tutomvc\TutoMVC::startup( "\\tutomvc\\theme\AppFacade", "src/templates", TRUE, "src/php", array("libs") );
}
