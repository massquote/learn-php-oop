<?php
/**
 * This class handles all cart request
 * This is the class cotroller or page
 * 
 * @Author: Felix Notarte
 * @Date:   2018-07-01 23:58:37
 * @Last Modified by:   Felix Notarte
 * @Last Modified time: 2018-07-02 00:33:57
 */
use Cart\Template;
use Cart\Model\Product;
use Cart\Library\ShoppingCart;

class Cart extends Template
{
	private $products;
	private $cart;

	/**
	 * use construct to initialize objecs
	 */
	function __construct()
	{
		$this->products = new Product();
		$this->cart 	= new ShoppingCart();
	}

	public function index()
	{
		$data['token'] 		= $this->cart->getToken(); 
		$data['credit']		= $this->cart->getCredit();

		$this->setTitle('Internet Shop | Cart')
				->setJs(['cart'])
				->loadView('cart' ,$data);
	}

	/**
	 * Get the count of items in the cart
	 * thru session. This ill be use as APi
	 * @param  string $token 
	 * @return [type]
	 */
	public function count(string $token ='')
	{
		// just a simple security check
		$this->checkPermission(['POST'] ,$token);

		$this->responseJson(['count'=>$this->cart->getCount()]);
	}

	/**
	 * This function will be the final
	 * checkout. Data may need to be in db
	 * for records and invoicing
	 * @param  string $token 
	 * @return none        
	 */
	public function checkout(string $token ='')
	{
		// just a simple security check
		$this->checkPermission(['POST'] ,$token);
		// for now lets just capture the grand total
		$transportFee = $_POST['transport'] ?? 0;

		// lets compute the total
		$grandTotal = $this->cart->getGrandTotal();
		$credit  	= $this->cart->getCredit();

		// amount to be purchase is bigger than credit
		if ($grandTotal > $credit)
		{
			$this->responseJson([],['Not enough credit']);
		}

		$credit = $credit - $grandTotal;
		$this->cart->setCredit($credit);
		// its time to errase the cart
		$this->cart->replaceCart([]);

		$this->responseJson(['token'=>$token]);
	}

	/**
	 * This will update the items in the cart
	 * according to request
	 * @param  string $token 
	 * @return none        
	 */
	public function update(string $token ='')
	{
		// just a simple security check
		$this->checkPermission(['POST'] ,$token);

		// check action if to update or delete
		$action = $_POST['action'] 	?? 'update';
		$id 	= $_POST['id'] 		?? 0;
		$qty	= $_POST['qty'] 	?? 1;
		$cart 	= [];

		if ($action =='update')
		{
			$cart = $this->processUpdate($id, $qty);
		}

		if ($action == 'delete')
		{
			$cart = $this->processDelete($id, $qty);
		}

		// time to save in cart
		$this->cart->replaceCart($cart);
		$this->responseJson([]);
	}

	/**
	 * this will delete all items with id
	 * parameter passed
	 * @param  int    $id 
	 * @return array     
	 */
	private function processDelete(int $id) : array 
	{
		$cartItems 	= $this->cart->getItems();
		$newCart 	=[];

		// lets remove all with the same id
		foreach ($cartItems as $key => $value) {
			if ($value['id'] ==$id)
			{
				continue;
			}
			$newCart[] = $value;
		}
		return $newCart;
	}

	/**
	 * function that is responsible of re arranging
	 * the cart in terms of updating quantity
	 * @param  int    $id  
	 * @param  int    $qty 
	 * @return array      
	 */
	private function processUpdate(int $id, int $qty) : array
	{
		$item 		= $this->products->getInfoById($id);
		$cartItems 	= $this->cart->getItems();
		$newCart 	= $this->processDelete($id);

		// now lets add the item according to qty
		for ($i=0; $i < $qty; $i++) { 
			$newCart[] = $item[0];
		}
		return $newCart;
	}

	/**
	 * function that is responsible on geting
	 * the whole items in the cart
	 * @param  string $token 
	 * @return none        
	 */
	public function items(string $token ='')
	{
		// just a simple security check
		$this->checkPermission(['POST'] ,$token);
		
		$cartItems = $this->cart->getItems();
		$groupedItems = [];

		// lets combine the same items
		foreach ($cartItems as $cItem)
		{
			$cItem['qty'] =1;
			// lets loop thru our group items if exist
			foreach ($groupedItems as $i => $gItem) {
				if ($gItem['id'] == $cItem['id'])
				{
					$cItem['qty'] =  $groupedItems[$i]['qty'] +1; 
					// remove so that we can assign it again
					unset($groupedItems[$i]);
				}
			}
			// lets add the subtotal
			$cItem['subtotal'] = number_format($cItem['qty'] * $cItem['price'],2,".",",");
			$groupedItems[] = $cItem;
		}

		$this->responseJson($groupedItems);
	}

	/**
	 * This will add the product according to request
	 * @param string $token 
	 */
	public function add(string $token ='')
	{
		// just a simple security check
		$this->checkPermission(['POST'] ,$token);

		// get the post values
		$id = $_POST['id'] ?? 0;
		$item = $this->products->getInfoById($id);

		// check if its a valid item
		if (empty($item))
		{
			$this->responseJson([], ['invalid item']);
		}
		// add in in cart
		$this->cart->add($item);
		// lets return the count
		$this->responseJson(['count'=>$this->cart->getCount()]);

	}

}