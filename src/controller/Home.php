<?php
/**
 * This class is the home controller
 * or home page. All request for home will
 * go here
 * 	
 * @Author: Felix Notarte
 * @Date:   2018-07-01 20:08:23
 * @Last Modified by:   Felix Notarte
 * @Last Modified time: 2018-07-02 00:07:05
 */

use Cart\Template;
use Cart\Session;
use Cart\Model\Product;
use Cart\Library\ShoppingCart;


class Home extends Template
{
	private $products;
	private $cart;

	/**
	 * use construct to initialize objecs
	 */
	function __construct()
	{
		$this->product 	= new Product();
		$this->cart 	= new ShoppingCart();
	}
	
	/**
	 * The index page of the app
	 * @return none
	 */
	public function index()
	{
		$data['products'] 	= $this->product->getProducts();
		$data['token'] 		= $this->cart->getToken(); 
		$data['credit']		= $this->cart->getCredit();

		$this->setTitle('Internet Shop')
				->setJs(['home'])
				->loadView('home', $data);

	}
}