<?php
Class Session{
	private $session;
	private $cart;

	public function __construct(){
		session_start();
		if($_SESSION['user_data'] && !empty($_SESSION['user_data'])) $this->session = $_SESSION['user_data'];
		else $this->session = $_SESSION['user_data'] = [];

		if($_SESSION['cart'] && !empty($_SESSION['cart'])) $this->cart = $_SESSION['cart'];
		else $this->cart = $_SESSION['cart'] = [];
	}

	// add session data
	public function setData($key, $val){
		$_SESSION['user_data'][$key] = $val;
	}

	// get session data
	public function getData(){
		return $this->session;
	}

	// remove from sessionData
	public function removeData($key){
	}

	// add item to cart
	public function addItem($itemData){
		// cart item id
		$id = count($this->cart) + 1;
		$pre = $itemData["isPizza"] == 1 ? "p" : "t";
		$this->cart[$pre . "-" . $itemData['id']] = $itemData;
		$_SESSION['cart'] = $this->cart;
	}

	// remove item from cart, return remove status
	public function removeItem($id){
		if(isset($this->cart[$id])){
			unset($this->cart[$id]);
			$_SESSION['cart'] = $this->cart;
			return true;
		}
		else return false;
	}

	// get cart items
	public function getCart(){
		return $this->cart;
	}

	// end session
	public function endSession(){
		session_destroy();
	}
}
?>
