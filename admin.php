<?php
	require_once("src/db.php");

	$db = new Db();
	$orders = $db->getOrders();
?><!DOCTYPE html>
<html>
	<head>
		<title>S.P.O.S| Admin Page</title>
		<script src="assets/jquery-3.3.1.min.js"></script>
		<link rel="stylesheet" href="assets/main.css">
		
	</head>
	<body>
		<header></header>
		<div><center>
			<p class="placed-order-title">Placed Orders</p>
			<table id="placed-order"><?php 
				foreach($orders as $row){ 
					$grandTotal = 0;?>
				<tr>
					<td><?=$row["id"]?></td>
					<td><?=$row["name"]?></td>
					<td><?=$row["contact_number"]?></td>
					<td><span class="view-details" data="<?=$row["id"]?>">View Order</span></td>
				</tr>
				<tr>
					<td class="od" colspan="4">
						<table class="details" id="detail-<?=$row["id"]?>" style="display: none;">
							<tr>
								<td>Pizza</td>
							</tr><?php
							$orderDetails = $db->getOrderDetails($row["id"]);
							$viewToppings = false;
							foreach ($orderDetails as $row) { 
								if(!$row["isPizza"] && !$viewToppings){
									$viewToppings = true; ?>
								<tr>
									<td>Toppings</td>
								</tr><?php } ?>
								<tr>
									<td><?=$row["name"]?></td>
									<td><?=$row["size"]?></td>
									<td><?=$row["qty"]?></td>
									<td><?=$row["price"]?></td>
<td><?=$row["GST"]?></td>
									<td> <?=$grandTotal += $row["qty"] * $row["price"]?></td>
								</tr>
							<?php }
						?>
							<tr>
								<td>Grand Total: <?=$grandTotal?></td>
							</tr>
						</table>
					</td>
				</tr>
				<?php }
			?></table>
			</center>
		</div>
		<footer></footer>
		<script type="text/javascript">
			$(".view-details").click(function(){
				var id = $(this).attr("data");
				$("#detail-" + id).slideDown(200);
			});
		</script>
		
	</body>
</html>
