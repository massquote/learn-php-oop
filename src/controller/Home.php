<?php
use Cart\Template;
use Cart\Model\Product;

class Home extends Template
{
	
	public function index()
	{
		/*
		$product = new Product();

		var_dump($product->getProducts());
		 */
		
		$this->setTitle('Home | Cart');
		$this->loadView('');

	}
}