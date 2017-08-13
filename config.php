<?php
// Here are some global settings, modify as needed

// Set to somewhere outside www root or prevent browsing
// Apache must be able to write to this directory
$orderdir = "orders";

// List of users is in an array so we do not complicate with a MySQL database
$logins = array(
		'admin' => 'password',
		'hacker' => 'Ab@123456',
);

session_start();
if(!isset($_SESSION['login_user']) && basename($_SERVER['PHP_SELF']) != 'index.php'){
	header("location: index.php");
	exit;
}

function gen_uuid() {
	return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			// 32 bits for "time_low"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
			
			// 16 bits for "time_mid"
			mt_rand( 0, 0xffff ),
			
			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 4
			mt_rand( 0, 0x0fff ) | 0x4000,
			
			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			mt_rand( 0, 0x3fff ) | 0x8000,
			
			// 48 bits for "node"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
			);
}

?>
