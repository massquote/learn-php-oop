<?php
/**
 * This class is responsible of rendering the entire page
 * 
 * @Author: junnotarte
 * @Date:   2018-07-01 10:07:27
 * @Last Modified by:   Felix Notarte
 * @Last Modified time: 2018-07-01 17:55:49
 */
namespace Cart;

use Cart\Session;

class Template
{	
	private $pageTemplate 	= '_page';
	private $customJs 		= [];
	private $title 			= '';
	
	function __construct(){}

	/**
	 * function that will load the partial view
	 * and combine with the tempalte
	 * @param  string $template partial view
	 * @param  array  $data     data to be passed in partial
	 * @return none 
	 */
	public function loadView(string $template, array $renderData = [])
	{
		$title 			= $this->title;
		$partialFile 	= $this->getPartial($template);
		$customJs 		= $this->customJs;
		$directoryPath 	= systemPath('views');
		$data 			= $renderData;
		 
		require_once $directoryPath.$this->pageTemplate.'.php';
	}

	/**
	 * This will just get the partial view
	 * and check if it exist. If not exist return empty
	 * @param  string $template 
	 * @return string           
	 */
	public function getPartial(string $template) : string
	{
		if (!$this->viewExist($template))
		{
			return '';
		}
		$directoryPath = systemPath('views');
		return $directoryPath.$template.'.php';
	}

	/**
	 * Sets title for html redering
	 * @param string $title 
	 */
	public function setTitle(string $title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * assign files in variable for redering
	 * in template
	 * @param array $fileNames 
	 */
	public function setJS(array $fileNames)
	{
		$this->customJs = $fileNames;
		return $this;
	}

	/**
	 * this will check if the view exist
	 * @param  string $viewName 
	 * @return boolean           
	 */
	private function viewExist(string $viewName) : bool
	{
		$directoryPath = systemPath('views');
		return file_exists($directoryPath . $viewName .'.php');
	}

	/**
	 * It use for redirection
	 * @param  string $url 
	 * @return none      
	 */
	public function redirect(string $url)
	{
		header('Location:' .$url);
		exit();
	}

	public function responseJson(array $rawData, array $errorData = [])
	{
		$data['status'] = 'success';
		$data['data'] = $rawData;

		if (!empty($errorData))
		{
			$data['status'] 	= 'error';
			$data['message'] 	= $errorData;
		}

		header("Content-type: application/json; charset=utf-8");
		echo json_encode($data);
		exit();
	}
	
	/**
	 * This will check if method and token
	 * are match if not end the session
	 * @param  array  $method 
	 * @param  string $token
	 * @return none         
	 */
	public function checkPermission(array $method, string $token) 
	{
		$session = new Session();

		if(!in_array($_SERVER['REQUEST_METHOD'], $method)
			|| $token != $session->getValue('token'))
		{
			http_response_code(403);
			echo 'Invalid request';
			exit();
		}
	}
}