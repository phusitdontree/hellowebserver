<html>
<head>
<meta charset="utf8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php

// Database Connection
	include("dbconnect.php");

// Autentication
// Authorization
// Show Menu
// Show Content

	$result=$conn->query("select * from KPI");
	if ($conn->connect_error) {
    	die("Connect Error (" . $conn->connect_errno . ") ". $conn->connect_error);
	}

	echo 'Success... ' . $conn->host_info . "\n";
	$fields = $result->fetch_fields();
	
	
	while($row=$result->fetch_assoc()){
		foreach($fields as $fvalue){
			  printf("%s : %s <br>",$fvalue->name,$row[$fvalue->name]);
		}
		echo "<hr>";
	}
	$result->free();
	$conn->close();
?>

</body>