<?php
/**
 * Base functions (includes/functions.php).
 * 
 * @author Intelligent Design (Sławomir Kaliszczak)
 * @copyright (c) 2012 Intelligent Design (Sławomir Kaliszczak)
 * @package Core
 * @file
 */ 

/**
 * Autoloader classes from library directory
 * @param type $className 
 */
function __autoload_classes($className) {
	
	$classDirecories = array('library', 'controllers', 'models');

	if (strstr($className, '_')) {
		$className = str_replace('_', '/', $className);
	}

	foreach ($classDirecories as $dir) {
		if (file_exists($classPath = APPLICATION_ROOT . '/' . $dir . '/' . $className.'.php')) {
			include $classPath;
			break;
		}
	}
}
/**
 * Prints named information in pre tags
 * @param type $varible
 * @param type $name 
 */
function dump($varible, $name = null) {

	if ((boolean)$name) {
		$name = '<b>'.$name.'</b> = ';
	}

	if (APPLICATION_ENVIRONMENT == 'DEVELOPMENT') {
		echo '<pre>'.$name.print_r($varible, true).'</pre>';
	}
}
/**
 * Converting string to chosen convension.<br />
 * @param string $string string to convert
 * @param string $to camel-case | uppear-camel-case | underscore-separeted
 */
function convert_case($string, $to) {

	$elements = array();
	
	// if is underscore separeted
	if (strstr($string, '_')) {
		$elements = explode('_', $string);
	}
	// if is minus separeted
	elseif (strstr($string, '-')) {
		$elements = explode('-', $string);
	}	
	// if is camel case
	else if (preg_match('/[A-Z]/', $string)) {
		$tmpString = preg_replace('/([A-Z])/', ' ${0}', $string);
		$tmpString = strtolower($tmpString);
		
		if ($tmpString[0] == ' ') {
			$tmpString = substr($tmpString, 1);
		}
		
		$elements = explode(' ', $tmpString);
	}
	else {
		$elements[] = $string;
	}
		
	switch($to) {
		case 'underscore-separeted' :
			$convertedString = implode('_', $elements);
			break;
		
		case 'camel-case' :
			$first = array_shift($elements);
			$convertedString = implode(' ', $elements);
			$convertedString = mb_convert_case($convertedString, MB_CASE_TITLE, 'UTF-8');
			$convertedString = str_replace(' ', '', $convertedString);
			$convertedString = $first . $convertedString;
			break;
		
		case 'uppear-camel-case' :
			$convertedString = implode(' ', $elements);
			$convertedString = mb_convert_case($convertedString, MB_CASE_TITLE, 'UTF-8');
			$convertedString = str_replace(' ', '', $convertedString);
			break;
		
		default :
			throw new Exception('Unknown name convencion "'.$to."'", E_USER_ERROR);
	}
	
	return $convertedString;
}