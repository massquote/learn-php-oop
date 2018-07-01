<?php
namespace Cart\Model;

use Cart\Model;
/**
 * 
 */
class Product extends Model
{
	function __construct(){}

	function getProducts()
	{
		return $this->setQuery('SELECT * from products')
				->getRows();
	}
}