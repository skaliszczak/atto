<?php
/**
 * System class.
 *  
 * @author Intelligent Design (S³awomir Kaliszczak)
 * @copyright (c) 2012 Intelligent Design (S³awomir Kaliszczak)
 * @package Core
 */
class System {
	/**
	 * Relative URI
	 */
	static protected $uri = null;
	/**
	 * Start system
	 */
	static public function start() {
		
		self::getRealURI();
		
		$requestParameters = explode('/', self::$uri);
		
		if (!array_key_exists(0, $requestParameters) || !$requestParameters[0]) {
			$requestParameters[0] = 'home';
		}
		if (!array_key_exists(1, $requestParameters) || !$requestParameters[1]) {
			$requestParameters[1] = 'index';
		}
		dump($requestParameters);
		$controllerName = convert_case(array_shift($requestParameters), 'uppear-camel-case');
		$action = convert_case(array_shift($requestParameters), 'camel-case');
		dump($controllerName, 'c');
		dump($action);
		
		if (class_exists($controllerName)) {
			$controller = new $controllerName();
			if (is_callable(array($controller, $action))) {
				echo call_user_func_array(array($controller, $action), $requestParameters);
			}
			else {
				echo '<h1>404: Not Found</h1>';				
			}
		}
		else {
			echo '<h1>404: Not Found</h1>';
		}
	}
	static protected function getRealURI() {
		$uri = $_SERVER['REQUEST_URI'];
		$file = $_SERVER['SCRIPT_NAME'];
		
		for ($i = 0, $length = strlen($uri) ; $i < $length ; $i++) {
			if ($uri[$i] !== $file[$i]) {
				self::$uri = substr($uri, $i);
				break;
			}
		}
		return self::$uri;
	}
}