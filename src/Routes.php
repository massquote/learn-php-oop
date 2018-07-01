<?php
/**
 * This class is responsible on including the
 * correct php file/class depending on the
 * request uri sent
 * 
 * @Author: junnotarte
 * @Date:   2018-07-01 08:12:41
 * @Last Modified by:   Felix Notarte
 * @Last Modified time: 2018-07-01 17:49:46
 */
namespace Cart;


class Routes 
{
	const DEFAULT_CLASS = 'Home';
	const DEFAULT_METHOD = 'index';

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
		$useClass = $this::DEFAULT_CLASS;
		$useMethod	= $this::DEFAULT_METHOD;
		// assume the index o is controller and 1 is method
		if (count($this->requestUri) > 0
			&& !empty($this->requestUri[0]))
		{
			$useClass = ucfirst($this->requestUri[0]);
			$useMethod = $this->requestUri[1] ?? $useMethod;

			// lets make sure we remove ? params
			if(strrpos($useMethod,'?')){
				$pos = strrpos($useMethod,'?');
				$useMethod = substr($useMethod, 0, $pos);
				$useMethod = str_replace('/','',$useMethod);
			}

			// lets consider the rest are arguments
			for ($ctr=2; $ctr < count($this->requestUri) ; $ctr++) {
				array_push($this->args, $this->requestUri[$ctr]);
			}
		}		

		$directoryPath = systemPath('controller');
		
		if (!file_exists($directoryPath . $useClass .'.php'))
		{
			$useClass = $this::DEFAULT_CLASS;
		}

		require_once($directoryPath . $useClass .'.php'); 

		$class = new $useClass();
		if (empty($useMethod) 
			|| !method_exists($class, $useMethod))
		{
			$useMethod = $this::DEFAULT_METHOD;
		}

		// lets call the class
		call_user_func_array(array($class, $useMethod), $this->args);		
	}
}