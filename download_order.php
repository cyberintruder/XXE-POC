<?php

include 'config.php';

$file = $_GET['order'];

if ( !preg_match('/[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}/', $file)) {
	print "Error - the order parameter does not contain a proper order ID, please check your submission.\n<br><br>";
}
else
{
	$fullpath = $orderdir . '/' . $file . '.xml';
	
	if (!is_file($fullpath)) {
		print "Incorrect order UUID.\n<br><br>";
	}
	
	else {
		header('Content-Description: File Transfer');
		header('Content-Type: application/xml');
		header('Content-Disposition: attachment; filename="'.basename($fullpath).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($fullpath));
		readfile($fullpath);
		exit;
	}
}

?>
