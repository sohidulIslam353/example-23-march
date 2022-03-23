<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

	<h1>Successfully Order Placed on Our Ecommerce</h1><br>
	<strong>Order Id (Tracking ID): {{ $order['order_id'] }}</strong><br>
	<strong>Order Date:{{ $order['date'] }} </strong><br>
	<strong>Total Amount: {{ $order['total'] }}</strong><br>
	<hr> 
	<strong>Name:{{ $order['c_name'] }}</strong><br>
	<strong>Phone:{{ $order['c_phone'] }}</strong><br>
	<strong>Address:{{ $order['c_address'] }}</strong><br>


</body>
</html>