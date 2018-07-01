<?php
/**
 * This class is responsible of rendering the entire page
 * 
 * @Author: junnotarte
 * @Date:   2018-07-01 10:07:27
 * @Last Modified by:   junnotarte
 * @Last Modified time: 2018-07-01 10:09:54
 */
namespace Cart;

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
	public function loadView(string $template, array $data = [])
	{
		$title 			= $this->title;
		$partial 		= $this->getPartial($template);
		$customJs 		= $this->customJs;
		$directoryPath 	= systemPath('views');
		
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
		$directoryPath = systemPath('view');
		return file_get_contents($directoryPath.$template.'.php');
	}

	/**
	 * Sets title for html redering
	 * @param string $title 
	 */
	public function setTitle(string $title)
	{
		$this->title = $title;
	}

	/**
	 * assign files in variable for redering
	 * in template
	 * @param array $fileNames 
	 */
	public function setJS(array $fileNames)
	{
		$this->customJs = $fileNames;
	}

	/**
	 * this will check if the view exist
	 * @param  string $viewName 
	 * @return boolean           
	 */
	private function viewExist(string $viewName) : bool
	{
		$directoryPath = systemPath('view');
		return file_exists($directoryPath . $viewName .'.php');
	}

	/**
	 * It use for redirection
	 * @param  string $url 
	 * @return none      
	 */
	function redirect(string $url)
	{
		header('Location:' .$url);
		exit();
	}
}