<html>
<head>
<meta charset="utf8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
	$authenticated=0;
// Database Connection
	include("dbconnect.php");
// Autentication
	// By User & Password

	$user=$_POST["muser"];
	$pass=md5($_POST["mpass"]);
	$skey=$_POST["skey"];
	$thisuserid=$_POST["thisuserid"];
	$res = $conn->query("select * from users where username='$user' and password='$pass'");
	if($res->num_rows>0){
		$row = $res->fetch_assoc();
 		$thisuserid=$row['uid'];
 		$thisgroupid=$row['gid'];
		$thisusername=$row["username"];
		session_start();
		$skey=md5(date("Ymd"),$pass);
		$_SESSION[$thisuserid]=$skey;
 		session_write_close();
	}

	// By Session ID
// Authorization
// Show Menu
// Show Content
	if($skey==$_SESSION[$thisuserid]){
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
	}
	else{
		include("loginform.php");
	}	
	$result->free();
	$conn->close();
?>

</body>