<!DOCTYPE html>
<html>
<head>
<title>Your Home Page</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<b id="welcome">Welcome : <i><?php
include('config.php');
echo($_SESSION['login_user']); ?></i></b>
<br><br>
Please choose one of the following options:
<br><br>
<ul>
	<li><a href="orders.php">View previous orders</a>
	<li><a href="new_order.php">Upload a new order</a>
</ul>
<b id="logout"><a href="logout.php">Log Out</a></b>
</div>
</body>
</html>