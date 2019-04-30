<?php
if(isset($_POST["add"])){
	if(isset($_POST["id"]) && $_POST["id"] != ""){
		if(isset($_POST["size"]) && $_POST["size"] != ""){
			if(isset($_POST["qty"]) && $_POST["qty"] != "" && $_POST["qty"] > 0){
				require_once("session.php");
				$sess = new Session();
				$itemData = [
					"id"		=> $_POST["id"],
					"isPizza"	=> 1,
					"size"		=> $_POST["size"],
					"qty"		=> $_POST["qty"]
				];
				$sess->addItem($itemData);
				exit("item added to cart");
			}
			else exit("invalid quantity");
		}
		else exit("invalid pizza size");
	}
	else exit("invalid id");
}
else if(isset($_POST["add-toppings"])){
	if(isset($_POST["id"]) && $_POST["id"] != ""){
		if(isset($_POST["size"]) && $_POST["size"] != ""){
			require_once("session.php");
			$sess = new Session();
			$itemData = [
				"id"		=> $_POST["id"],
				"isPizza"	=> 0,
				"size"		=> $_POST["size"],
			];
			$sess->addItem($itemData);
			exit("item added to cart");
		}
		else exit("invalid toppings size");
	}
	else exit("invalid id");
}
else if(isset($_POST["remove"])){
	if(isset($_POST["id"]) && $_POST["id"] != ""){
		require_once("session.php");
		$sess = new Session();
		$rem = $sess->removeItem("p-" . $_POST["id"]);
		exit($rem ? "item has been removed from cart" : "item not on cart");
	}
	else exit("invalid id");
}
else if(isset($_POST["remove-toppings"])){
	if(isset($_POST["id"]) && $_POST["id"] != ""){
		require_once("session.php");
		$sess = new Session();
		$rem = $sess->removeItem("t-" . $_POST["id"]);
		exit($rem ? "item has been removed from cart" : "item not on cart");
	}
	else exit("invalid id");
}
else if(isset($_POST['place-order'])){
	if(isset($_POST['name']) && $_POST['name'] != "" && isset($_POST['contact']) && $_POST['contact'] != ""){
		require_once("session.php");
		require_once("db.php");

		$db = new Db();
		$sess = new Session();

		$or = $db->placeOrder($_POST['name'], $_POST['contact'], $sess->getCart());
		echo "success:+:".$or;
		//$sess->endSession();
	}
	else exit("failed:+:Please complete the required feild");
}
?>
