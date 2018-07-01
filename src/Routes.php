<?php
/**
 * This class is responsible on including the
 * correct php file/class depending on the
 * request uri sent
 * 
 * @Author: junnotarte
 * @Date:   2018-07-01 08:12:41
 * @Last Modified by:   junnotarte
 * @Last Modified time: 2018-07-01 09:52:11
 */
namespace Cart;


class Routes 
{
	private $requestUri = [];
	private $args 		= [];

	/**
	 * lets just get the request uri during instantiation
	 */
	function __construct()
	{
		$this->requestUri = explode('/', substr($_SERVER['REQUEST_URI'], 1));
	}

	/**
	 * it will check if the passed uri have corresponding
	 * controller and method
	 * 
	 * @return none
	 */
	function loadController()
	{
		$useClass = 'Home';
		$useMethod	= 'index';
		// assume the index o is controller and 1 is method
		if (count($this->requestUri) > 0
			&& !empty($this->requestUri[0]))
		{
			$useClass = ucfirst($this->requestUri[0]);
			$useMethod = $this->requestUri[1] ?? $userMethod;

			// lets consider the rest are arguments
			for ($ctr=2; $ctr < count($this->requestUri) ; $ctr++) { 
				array_push($this->args, $this->requestUri[$ctr]);
			}
		}		

		$directoryPath = systemPath('controller');
		
		if (file_exists($directoryPath . $useClass .'.php'))
		{
			require_once($directoryPath . $useClass .'.php'); 
		}

		if (!class_exists($useClass))
		{
			$useClass = 'Home';
		}

		$class = new $useClass();

		if (!method_exists($class, $useMethod))
		{
			$userMethod = 'index';
		}

		// lets call the class
		call_user_func_array(array($class, $useMethod), $this->args);		
	}
}