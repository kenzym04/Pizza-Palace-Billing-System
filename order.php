<?php
	require_once("src/db.php");
	require_once("src/session.php");

	$db = new Db();
	$sess = new Session();

	$classicPizzas = $db->getPizzas("CLASSIC PIZZA");
	$specialtyPizzas = $db->getPizzas("DELUXE TOPPINGS");
	$pizzas = array_merge($classicPizzas, $specialtyPizzas);
	$toppings = $db->getToppings();

	$cart = $sess->getCart();
	$grandTotal = 0;

	foreach($cart as $row){
		if($row["isPizza"]) $subTotal = $row["qty"] * $pizzas[$row["id"]-1]["size_and_price"][$row["size"]];
		else $subTotal = $toppings[$row["id"]-1]["size_and_price"][$row["size"]];
		$grandTotal += $subTotal;
$T = $grandTotal * $tax;
                            $grandTotal += $T;
	}
	echo "<pre>";
	//print_r($cart);
	echo "</pre>";
?><!DOCTYPE html>
<html>
	<head>
		<title>Pizza Order Summary</title>
		<script src="assets/jquery-3.3.1.min.js"></script>
		<link rel="stylesheet" href="assets/main.css?<?=date("His")?>">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script>
			$(document).ready(function(){
				$("#order").on("submit", function(e){
					e.preventDefault();
					$("#action-status").html("Processing request . . . Please wait");
					var name = $("#name").val();
					var contact = $("#contact").val();
					var data = "place-order&name=" + encodeURIComponent(name) + "&contact=" + encodeURIComponent(contact);
					$.ajax({
						url: "src/request.php",
						type: "post",
						data: data,
						success: function(ret){
							returnData = ret.split(":+:");
							if(returnData[0] == "success"){
								$("#action-status").html("You have successfully placed your order with Order Number: " + returnData[1] + ". Please wait for our staff to call you for confirmation. Thank you.");
							}
							else $("#action-status").html("Failed to process request with error: " + returnData[1]);
						}
					});
				});
			});
		</script>
	</head>
	<body>
		<header></header>
		<div>
			<p class="order-title">Order Summary</p>
			<table id="order-summary">
				<tr>
					<td class="heading" colspan="5">Pizza</td>
				</tr>
				<tr class="column-title">
					<td colspan="1">Name</td>
					<td colspan="1">Size</td>
					<td colspan="1">Quantity</td>
					<td colspan="1">Unit Price</td>
<td colspan="1">GST is 5%</td>
					<td colspan="1">Total</td>
				</tr><?php
				foreach($cart as $row){ 
					if($row["isPizza"]){ ?>
				<tr>
					<td><?=$pizzas[$row["id"]-1]["name"]?></td>
					<td><?=$row["size"]?></td>
					<td><?=$row["qty"]?></td>
					<td><?=number_format($pizzas[$row["id"]-1]["size_and_price"][$row["size"]], 2)?>
					<td><?=number_format($row["qty"] * $pizzas[$row["id"]-1]["size_and_price"][$row["size"]], 2)?></td>
				</tr>
				<?php }} ?><tr><td colspan="5"><br></td></tr>
				
				<tr>
					<td class="heading" colspan="5">Toppings</td>
				</tr>
				<tr class="column-title">
					<td colspan="1">Name</td>
					<td colspan="1">Size</td>
					<td colspan="1">Quantity</td>
					<td colspan="1">Unit Price</td>
<td colspan="1">GST is 5%</td>
					<td colspan="1">Total</td>
				</tr><?php
				foreach($cart as $row){ 
					if($row["isPizza"]){ ?>
				<tr>
					<td><?=$toppings[$row["id"]-1]["name"]?></td>
					<td><?=$row["size"]?></td>
					<td>1</td>
					<td><?=number_format($toppings[$row["id"]-1]["size_and_price"][$row["size"]], 2)?>
					<td><?=number_format($toppings[$row["id"]-1]["size_and_price"][$row["size"]], 2)?></td>
				</tr>
				<?php }} ?>
				<tr>
					<td id="gt-container" colspan="5">Grand Total: <span id="grand-total"><?=number_format($grandTotal, 2)?></span></td>
				</tr>
			</table>
			<p id="action-status"></p>
			<form id="order">
				<input id="name" type="text" name="name" placeholder="Full Name">
				<input id="contact" type="text" name="contact" placeholder="Contact Number">
				<input type="submit" value="Place Order">
			</form>
		</div>
		<footer><a href="admin.php">View Total Orders</a></footer>
	</body>
</html>
