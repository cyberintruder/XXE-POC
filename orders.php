<!DOCTYPE html>
<html>
<head>
<title>List of previous orders</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<b id="welcome">Welcome : <i><?php

include 'config.php';

echo($_SESSION['login_user']); ?></i></b>
<br><br>
Here are your orders:<br><br>
<ul>
<?php 

// List contets of the directory holding orders

$orders = scandir($orderdir);

foreach ($orders as $order) {
	if (is_file($orderdir . '/' . $order) && substr($order, -4, 4) == '.xml') {
		$ordername = rtrim($order, '.xml');
		print "<li>Order $ordername. " . "<a href=\"view_order.php?order=$ordername\">View the order</a> or " . "<a href=\"download_order.php?order=$ordername\">download</a> it.";
	}
}

?>
</ul>
<b id="logout"><a href="profile.php">Go back</a></b>
</div>
</body>
</html>