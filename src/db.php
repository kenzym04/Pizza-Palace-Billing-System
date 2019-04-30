<?php
Class Db{
	private $con;

	function __construct($db = "pizza_order"){
		$this->con = mysqli_connect("localhost", "root", "", $db);
		if(mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

		$this->query("select * from pizza");
	}

	private function query($query){
		$res = mysqli_query($this->con, $query);
		if(!$res){
			echo "Error Description: " . mysqli_error($this->con);
			return false;
		}
		$data = mysqli_fetch_all($res, MYSQLI_ASSOC);
		return $data;
	}

	/* Get pizzas by category and prices per size*/
	public function getPizzas($category){
		$pizzas = $this->query("select * from pizza where category = '" . $category . "'");
		foreach($pizzas as $key => $val){
			$size_and_price = $this->query("select * from pizza_size where pizza_id = " . $val["id"]);
			foreach($size_and_price as $row){
				$pizzas[$key]["size_and_price"][$row["size"]] = $row["price"];
			}
		}
		return $pizzas;
	}

	public function getToppings(){
		$toppings = $this->query("select * from toppings");
		foreach($toppings as $key => $val){
			$size_and_price = $this->query("select * from toppings_size where toppings_id = " . $val["id"]);
			foreach($size_and_price as $row){
				$toppings[$key]["size_and_price"][$row["size"]] = $row["price"];
			}
		}
		return $toppings;
	}

	// place order
	public function placeOrder($name, $contact, $order){
		$timestamp = date("YmdHis");
		$query = "insert into orders (time_placed, name, contact_number) value ('" . $timestamp . "', '" . $name . "', '" . $contact . "')";
		mysqli_query($this->con, $query);

		//get newly placed order's id
		$res = mysqli_query($this->con, "select id from orders order by id desc limit 1");
		$id = mysqli_fetch_all($res, MYSQLI_ASSOC)[0]['id'];

		foreach($order as $row){
			mysqli_query($this->con, "insert into order_details values ('" . $id . "', '" . $row["id"] . "', '" . $row["isPizza"] . "', '" . ($row["isPizza"] ? $row["qty"] : 1) . "', '" . $row["size"] . "')");
		}

		return $id;
	}

	// get orders
	public function getOrders(){
		$query = "select * from orders";
		$res = mysqli_query($this->con, $query);
		$data = mysqli_fetch_all($res, MYSQLI_ASSOC);
		return $data;
	}

	// get order details of specific order
	public function getOrderDetails($oid){
		$query = "select od.item_id, od.isPizza, od.qty, od.size, p.name, ps.price from order_details as od
					inner join pizza as p on od.item_id = p.id
				    inner join pizza_size as ps on od.size = ps.size and od.item_id = ps.pizza_id
					where od.order_id = " . $oid . " and od.isPizza = 1
				union
				select od.item_id, od.isPizza, od.qty, od.size, t.name, ts.price from order_details as od
					inner join toppings as t on od.item_id = t.id
				    inner join toppings_size as ts on od.size = ts.size and od.item_id = ts.toppings_id
					where od.order_id = " . $oid . " and od.isPizza = 0";
		$res = mysqli_query($this->con, $query);
		$data = mysqli_fetch_all($res, MYSQLI_ASSOC);
		return $data;
	}
}
?>
