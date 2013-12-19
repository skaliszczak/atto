<?php
/**
 * Main bootstrap file (index.php).
 * 
 * @author Intelligent Design (S³awomir Kaliszczak)
 * @copyright (c) 2012 Intelligent Design (S³awomir Kaliszczak)
 * @package Core
 */
	
	define('APPLICATION_ENVIRONMENT', 'DEVELOPMENT');
	
	include 'includes/initialize.php';
	
	System::serviceRegister('Ajax', '@/ajax/.*$@');
	System::serviceRegister('Panel', '@^/panel(?<path>/(([a-zA-Z0-9_-]+)(/|$))+)((?<params>(([a-zA-Z0-9_-]+),?)+)\.html|)@');
	System::serviceRegister('Panel', '@^/panel/.*$@');
	System::serviceRegister('ModelsWriter', '@^/generate-models/$@');
	System::serviceRegister('WebPage', '@^(?<path>/(([a-zA-Z0-9_-]+)(/|$))*)((?<params>(([a-zA-Z0-9_-]+),?)+)\.html|)@');
	System::serviceRegister('WebPage', '@^.*$@');
	
	System::start( System::MODE_CMS);
	
