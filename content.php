<?php
if(isset($_GET["app_id"])){
	$q="select link from submenu where submenuid=".$_GET["app_id"];
	$res = $conn->query($q);
	if($res->num_rows>0){
		$row = $res->fetch_assoc();
		$link=explode("?",$row["link"]);
		//if(!empty($link[1])) echo $link[1];

		include($link[0]);
	}
	$app_id=$_GET["app_id"];
	if($app_id==-1){
		include("users.php");
	}
	else if($app_id==-2){
		include("groups.php");
	}
	else if($app_id==-3){
		include("permissions.php");
	}
	else if($app_id==-4){
		include("menus.php");
	}
	else if($app_id==-5){
		include("submenus.php");
	}
	
}

?>