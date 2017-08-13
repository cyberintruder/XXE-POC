<!DOCTYPE html>
<html>
<head>
<title>Your order</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<b id="welcome">Here are your order details: <i><?php

include 'config.php';
session_start();

$file = $_GET['order'];

if ( !preg_match('/[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}/', $file)) {
	print "Error - the order parameter does not contain a proper order ID, please check your submission.\n<br><br>";
}
else
{
	$fullpath = $orderdir . '/' . $file . '.xml';
	
	class order {
		var $item;
		var $amount;
	}
	
	$xmlDoc = new DOMDocument();
	$xmlDoc->resolveExternals = true;
	$xmlDoc->substituteEntities = true;
	
	$xmlFile = file_get_contents($fullpath);
	
	// Simple regex remove any /dev/random, /dev/urandom and /dev/zero references
	// We don't want people (easily) killing our server
	// Of course this can be circumvented but it's just a simple check
	$xmlFile = preg_replace('/(\/dev\/zero|\/dev\/random|\/dev\/urandom)/', '', $xmlFile);
	
	if (@$xmlDoc->loadXML($xmlFile) === false) {
		print "There was an error processing the XML file, bailing out.\n";
		exit;
	}
	
	$rootelement = $xmlDoc->getElementsByTagName("order");
	
	// Check if there is order root element, if not bail out
	if ( $rootelement->length == 0 ) {
		print "Incorrect XML, no order\n";
		exit;
	}
	
	// Process all items
	$items = $xmlDoc->getElementsByTagName("item");
	$i = 0;
	
	foreach ( $items as $x ){
		$newOrder = new order;
		$authors = $x->getElementsByTagName("name");
		$newOrder->item = $authors->item(0)->nodeValue;
		
		$titles = $x->getElementsByTagName("amount");
		$newOrder->amount = $titles->item(0)->nodeValue;
		
		$orders[$i] = $newOrder;
		$i++;
		
		//array_push($orders, $newOrder);
	}
	
	print "<ul>\n";
	
	foreach ( $orders as $x ) {
		print "<li>Item: " . $x->item . ", amount: " . $x->amount . "\n";
	}
	
	print "</ul>\n";
	
}
?>
<b id="logout"><a href="profile.php">Go back</a></b>
</div>
</body>
</html>