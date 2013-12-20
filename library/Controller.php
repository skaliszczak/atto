<?php
/**
 * Controller class proces data and fills view with.
 * 
 * @author Intelligent Design (S³awomir Kaliszczak)
 * @copyright (c) 2012 Intelligent Design (S³awomir Kaliszczak)
 * @package Core
 */
class Controller {
 
	/**
	 * Array of view vars
	 * @var array 
	 */
	public $vars = array();

	/**
	 * Proces view with vars and returns output. 
	 * Output is NOT added to contents property.
	 * @param string $name
	 * @param string $viewsDirectory [optional]
	 * @param string $vars [optional]
	 * @return string
	 */
	public function view($name, $viewsDirectory = null, $vars = null) {
		
		
		$bufferingStarted = false;
		$bufferingStoped = false;
		
		if (is_null($viewsDirectory)) {
			$viewsDirectory = 'views/' . get_called_class() . '/';
		}
		
		if (!is_null($vars)) {
			$this->vars = array_merge($this->vars, $vars);
		}
		
		extract($this->vars);

		try {
			$bufferingStarted = ob_start();
			include($viewsDirectory .$name.'.phtml');
			$contents = ob_get_contents();
			$bufferingStoped = ob_end_clean();
		}
		catch (Exception $exception) {
			if ($bufferingStarted && !$bufferingStoped) {
				ob_end_clean();
			}
			throw $exception;
		}
		
		return $contents;
	}
}

?>