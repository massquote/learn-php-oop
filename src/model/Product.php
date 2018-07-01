<?php
/**
 * This class is responsble on querying
 * data from data
 * 
 * @Author: Felix Notarte
 * @Date:   2018-07-01 10:47:53
 * @Last Modified by:   Felix Notarte
 * @Last Modified time: 2018-07-01 17:31:31
 */
namespace Cart\Model;

use Cart\Model;

class Product extends Model
{
	function __construct(){}

	/**
	 * Get the entire records of product
	 * @return array 
	 */
	public function getProducts() : array
	{
		return $this->setQuery('SELECT * FROM products')->getRows();
	}

	/**
	 * Function the will get the info of a certain
	 * product base on Id
	 * @param  int    $id 
	 * @return array     
	 */
	public function getInfoById(int $id) : array
	{
		return $this->setQuery('SELECT * FROM products WHERE id = %d')
				->setData([$id])
				->getRows();
	}
}