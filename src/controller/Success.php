<?php
use Cart\Template;
use Cart\Model\Product;
use Cart\Library\ShoppingCart;


class Success extends Template
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
	public function index(string $token ='')
	{
		// just a simple security check
		$this->checkPermission(['GET'] ,$token);

		$data['token'] 		= $this->cart->getToken(); 
		$data['credit']		= $this->cart->getCredit();

		$this->setTitle('Internet Shop')
				->loadView('success', $data);

	}
}