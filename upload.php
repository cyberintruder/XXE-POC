<?php

include('config.php');

// We automatically generate new names for processed orders. Names will be UUID's
$new_name = gen_uuid();
$target_file = $orderdir . '/' . $new_name . '.xml';

$uploadOk = 1;

if ($_FILES["fileToUpload"]["size"] > 50000) {
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
}

// File must be an XML file. Currently we don't bother verifying if it is proper XML file
// If it's not - it will fail in the view order screen anyway
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
if($FileType != "xml" ) {
	echo "Sorry, only XML files are allowed.";
	$uploadOk = 0;
}

if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		echo "<!DOCTYPE html><html><head><title>List of previous orders</title><link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\"></head><body>";
		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded as new order $new_name.";
		echo "<br><br>";
		echo "<b id=\"logout\"><a href=\"profile.php\">Go back</a></b></div></body></html>";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}
?>