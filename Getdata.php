<?php
if(isset($_REQUEST["submit"]))
{
	$servername = "localhost";
	$username = "root";
	$password = "toor";
	$dbname = "dvwa";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}

	//echo "Connected successfully";
	$name = $_POST[ 'name' ]; 
	$sql = "SELECT * FROM datastore where name='$name'";
	echo " You ran the sql query =". $sql. "<br/>";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
			$_name = $row["name"];
			$_age = $row["age"];
			$_fname = $row["fname"];
			$_lname = $row["lname"];
        		echo "<br> user: ". $_name. " <br/>  age: ". $_age. "<br/> Last Name " . $_fname . "<br>";

			$sql2 = "SELECT * FROM datastore where fname='$_fname'"; //paylaod executes here -interanl query
			echo " You ran the sql query =". $sql2. "<br/>";
			$result2 = $conn->query($sql2);
			if ($result2->num_rows > 0)
			{
                		while($row2 = $result2->fetch_assoc()) {
	                        	$name2 = $row2["name"];
        	                	$age2 = $row2["age"];
                	        	$fname2 = $row2["fname"];
                        		$lname2 = $row2["lname"];

					echo "<h1>".$name2."</h1>";
					echo "<h1>".$age2."</h1>";
					echo "<h1>".$fname2."</h1>";
					echo "<h1>".$lame2."</h1>";
    				}
			}
			else {	echo "0 results from payload query";	}
		}
	} 
	else {	echo "0 results";	}

	// sql to create table
	//$sql = "CREATE TABLE datastore ( name varchar(20), age int, fname varchar(20), lname varchar(20) )";

	//if ($conn->query($sql) === TRUE) {
    	//	echo "Table datastore created successfully";} 
	//else {	echo "Error creating table: " . $conn->error;	}
	

	
	
	$conn->close();

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Get User Details </title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
<h1>Insert user name</h1>
<div id="login">
<form action="Getdata.php" name="foo" method="post">
<label>Name :</label>
<input id="name" name="name" placeholder="name" type="text">
<input name="submit" type="submit" value="submit">
</form>
</div>
</div>
</body>
</html>


