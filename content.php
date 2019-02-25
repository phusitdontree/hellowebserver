<?php
if(isset($_GET["app_id"])){
	$q="select link from submenu where submenuid=".$_GET["app_id"];
	$res = $conn->query($q);
	if($res->num_rows>0){
		$row = $res->fetch_assoc();
		include($row["link"]);
	}
	if($_GET["app_id"]==-1){
		include("users.php");
	}
}

?>