<?php
	session_save_path("/var/www/html/mwap/workspace/webportal/tmp");
	session_start();
	
	$user=$_POST["muser"];
	$pass=md5($_POST["mpass"]);
	$skey=$_POST["skey"];
	$thisuserid=$_POST["thisuserid"];
	$q="select * from users where username='$user' and password='$pass'";
	$res = $conn->query($q);
	if($res->num_rows>0){
		$row = $res->fetch_assoc();
 		$thisuserid=$row['uid'];
 		$thisgroupid=$row['gid'];
		$thisusername=$row["username"];
		
		$skey=md5(date("Ymd"),$pass);
		$_SESSION[md5($thisuserid)]=$skey;
		//echo "login pass";
 		session_write_close();
 		
		
	}
	if($_GET["id"]>0){
		$thisuserid=$_GET["id"];
		$skey=$_SESSION[md5($thisuserid)];	
		if(isset($skey)){
			$q="select * from users where uid=".$thisuserid;
			$res = $conn->query($q);
			if($res->num_rows>0){
				$row = $res->fetch_assoc();
				$thisgroupid=$row["gid"];
				$thisusername=$row["username"];
		
			}

		}
		
	}
	
	
	
?>