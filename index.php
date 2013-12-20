<?php
/**
 * Main bootstrap file (index.php).
 * 
 * @author Intelligent Design (Sławomir Kaliszczak)
 * @copyright (c) 2012 Intelligent Design (Sławomir Kaliszczak)
 * @package Core
 */
	
	define('APPLICATION_ENVIRONMENT', 'DEVELOPMENT');
	define('APPLICATION_ROOT', dirname(__FILE__));
	
	include 'includes/initialize.php';

	System::start();
 