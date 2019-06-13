<?php
	$connect=mysqli_connect("localhost","dev2","Map@2019","mapis");
	$connect->query("SET NAMES UTF8");
	$page = isset($_GET['p']) ? $_GET['p'] : '';
	if($page == 'save'){
		$output="";
		$submenuid=$_POST["edit_submenuid"];
		$menuid=$_POST["edit_menuid"];
		$menuname=mysqli_real_escape_string($connect,$_POST["edit_menuname"]);
		$description=mysqli_real_escape_string($connect,$_POST["edit_description"]);
		$link=mysqli_real_escape_string($connect,$_POST["edit_link"]);
		$q="update submenu set menuid=$menuid,menuname='$menuname',description='$description',link='$link' where submenuid=$submenuid";
		$result=$connect->query($q);
		if ($connect->connect_error) $output="Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error;
		else $output="Record Saved";

		echo $output;
	}
	else if($page == 'del'){
		$myid = $_POST['id'];
		
		$id = str_replace(' ',',',$myid);
		$q="delete from submenu where submenuid in($id)";
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}	
	}
	else if($page == 'delpm'){
		$myid = $_POST['id'];
		
		$id = str_replace(' ',',',$myid);
		$q="delete from permissions where pmid in($id)";
		$result=$connect->query($q);
		//if ($connect->connect_error) {
		//	die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		//}	
	}
	else if($page == 'edit'){
		$myid = $_POST['id'];
		$q="select * from submenu where submenuid=".$myid;
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
		$output='';
		while($row=$result->fetch_assoc()){
			$output=$row["submenuid"].",".$row["menuid"].",".$row["menuname"].",".$row["description"].",".$row["link"];
		}
		echo $output;
	}
	else if($page == 'permission'){
		$myid = $_POST['id'];
		$q="select * from grouppermission where submenuid=".$myid;
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
		$output='';
		while($row=$result->fetch_assoc()){
			$permission="";
			if($row["permission"][0]==1)	$permission="Add ";
			if($row["permission"][1]==1)	$permission.="Edit ";
			if($row["permission"][2]==1)	$permission.="Delete ";
			if($row["permission"][3]==1)	$permission.="Special";
			$output.='<tr><td><input type="checkbox" class="checkpm" value="'.$row["pmid"].'" /></td><td>'.$row["groupname"].'</td><td>'.$permission.'</td></tr>';
		}
		echo $output;
	}
	
	else if($page == 'view'){
		//$q="select uid,username,realname,mobile,email,lineid,u.gid,groupname from users u left join groups g on u.gid=g.gid";
		$q="SELECT sm.submenuid, sm.menuid, m.menuname AS menuname, sm.menuname AS submenuname, sm.description, link, 
		GROUP_CONCAT( CONCAT( p.groupname,  '(', p.permission,  ')' ) SEPARATOR  '<br />' ) as grouppermission FROM  `submenu` AS sm
		LEFT JOIN menu AS m ON sm.menuid = m.menuid LEFT JOIN grouppermission AS p ON sm.submenuid = p.submenuid GROUP BY sm.submenuid";
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
		$output='';
		while($row=$result->fetch_assoc()){

			$output .= '<tr><td><input type="checkbox" class="checkitem" value="'.$row["submenuid"].'" /></td>
			<td>'.$row["submenuid"].'</td>
			<td>'.$row["menuname"].'</td>
			<td>'.$row["submenuname"].'</td>
			<td>'.$row["description"].'</td>
			<td>'.$row["link"].'</td>
			<td>'.$row["grouppermission"].'</td>
			</tr>';	
		}
		echo $output;
	}
	else if($page == 'add'){
		$output='';
		$menuid=mysqli_real_escape_string($connect,$_POST["ins_menuid"]);
		$menuname=mysqli_real_escape_string($connect,$_POST["ins_menuname"]);
		$description=mysqli_real_escape_string($connect,$_POST["ins_description"]);		
		$link=mysqli_real_escape_string($connect,$_POST["ins_link"]);		
		$query="INSERT INTO submenu (menuid,menuname,description,link) VALUES ($menuid,'$menuname','$description','$link')";
		//echo $query;
		$result=mysqli_query($connect,$query);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
	}
	else if($page == 'addpm'){
		
		$submenuid=mysqli_real_escape_string($connect,$_POST["id"]);
		$gid=mysqli_real_escape_string($connect,$_POST["gid"]);
		$permission=mysqli_real_escape_string($connect,$_POST["pm"]);
		//$permission=mysqli_real_escape_string($connect,($_POST["edit_pm1"]=="on"?"1":"0").($_POST["edit_pm2"]=="on"?"1":"0").($_POST["edit_pm3"]=="on"?"1":"0").($_POST["edit_pm4"]=="on"?"1":"0"));
		
		$query="insert into permissions (gid,menuid,submenuid,permission) values ($gid,(select menuid from submenu where submenuid=$submenuid),$submenuid,'$permission')";
		//echo $query;
		$result=mysqli_query($connect,$query);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
		
	}
?>