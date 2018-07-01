<?php
/**
 * This handles all shopping cart activities
 * like computation and session process 
 * 
 * @Author: junnotarte
 * @Date:   2018-07-01 15:35:44
 * @Last Modified by:   Felix Notarte
 * @Last Modified time: 2018-07-01 23:56:13
 */

namespace Cart\Library;

use Cart\Model;
use Cart\Session;

class ShoppingCart extends Model
{
	private $session;

	/**
	 * lets just initiate the session
	 */
	function __construct()
	{
		$this->session = new Session();
	}

	/**
	 * This will just get the token from session
	 * @return string 
	 */
	public function getToken() : string
	{
		if ($this->session->getValue('token'))
		{
			return $this->session->getValue('token');
		}

		return $this->session->generateToken();
	}

	/**
	 * This will get the items in the cart session
	 * @return array 
	 */
	public function getItems() : array
	{
		return $this->session->getValue('cart') ?? [];
	}

	/**
	 * This will compute the amount total
	 * in the cart
	 * @return [type] [description]
	 */
	public function getGrandTotal() : float
	{
		$cartItems 	=  $this->session->getValue('cart');
		$grandTotal = 0;

		foreach ($cartItems as $key => $value) {
			$grandTotal = $grandTotal + $value['price'];
		}
		return $grandTotal;
	}

	/**
	 * This will replace the value of cart 
	 * in session
	 * @param  array  $newCart 
	 * @return none          
	 */
	public function replaceCart(array $newCart)
	{
		$this->session->setValue('cart', $newCart);
	}

	/**
	 * Get the credit amount in the session
	 * @return [type] [description]
	 */
	public function getCredit() : float
	{
		$credit = $this->session->getValue('credit') ?? 100;

		if (floatval($credit) <=0)
		{
			$credit = 0;
		}
		return $credit;
	}

	/**
	 * This will set the value of credit in session
	 * @param float $credit 
	 */
	public function setCredit(float $credit) 
	{
		$this->session->setValue('credit', $credit);
	}

	/**
	 * function that will insert an item
	 * on the session
	 * @param  $item 
	 */
	public function add(array $item)
	{
		$cart = $this->session->getValue('cart') ?? [];
		array_push($cart, $item[0]);
		$this->session->setValue('cart', $cart);
	}

	/**
	 * this will count the number of arrays
	 * inside the cart session
	 * @return int 
	 */
	public function getCount() : int
	{
		return count($this->session->getValue('cart'));
	}
}