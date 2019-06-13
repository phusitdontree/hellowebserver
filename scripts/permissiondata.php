<?php
	$connect=mysqli_connect("localhost","dev2","Map@2019","mapis");
	$connect->query("SET NAMES UTF8");
	$page = isset($_GET['p']) ? $_GET['p'] : '';
	if($page == 'save'){
		$output="";
		$pmid=$_POST["edit_pmid"];
		$gid=mysqli_real_escape_string($connect,$_POST["edit_gid"]);
		$edit_menuid=$_POST["edit_menuid"];
		$menuid=mysqli_real_escape_string($connect,substr($edit_menuid,0,strpos($edit_menuid,":")));
		$submenuid=mysqli_real_escape_string($connect,substr($edit_menuid,strpos($edit_menuid,":")+1));
		$permission=mysqli_real_escape_string($connect,($_POST["edit_pm1"]=="on"?"1":"0").($_POST["edit_pm2"]=="on"?"1":"0").($_POST["edit_pm3"]=="on"?"1":"0").($_POST["edit_pm4"]=="on"?"1":"0"));
		$q="update permissions set gid=$gid ,menuid=$menuid,submenuid=$submenuid,permission='$permission' where pmid=$pmid";
		$result=$connect->query($q);
		if ($connect->connect_error) $output="Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error;
		else $output="Record Saved";

		echo $output;
	}
	else if($page == 'del'){
		$myid = $_POST['id'];
		
		$id = str_replace(' ',',',$myid);
		$q="delete from permissions where pmid in($id)";
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
			
		}	
	}
	else if($page == 'edit'){
		$myid = $_POST['id'];
		$q="select * from permissions where pmid=".$myid;
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
		$output='';
		while($row=$result->fetch_assoc()){
			$output=$row["pmid"].",".$row["gid"].",".$row["menuid"].",".$row["submenuid"].",".$row["permission"].",";

		}
		echo $output;
	}
	else if($page == 'view'){
		//$q="select uid,username,realname,mobile,email,lineid,u.gid,groupname from users u left join groups g on u.gid=g.gid";
		$q="SELECT pmid, pm.gid, groupname, pm.menuid, m.menuname AS menu, sm.submenuid, sm.menuname AS submenu, permission
		FROM  `permissions` AS pm LEFT JOIN groups AS g ON pm.gid = g.gid LEFT JOIN menu AS m ON pm.menuid = m.menuid
		LEFT JOIN submenu AS sm ON pm.submenuid = sm.submenuid";
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
		$output='';
		while($row=$result->fetch_assoc()){
			$permission="";
			if($row["permission"][0]==1) $permission="Add ";
			if($row["permission"][1]==1)	$permission.="Edit ";
			if($row["permission"][2]==1)	$permission.="Delete ";
			if($row["permission"][3]==1)	$permission.="Special";
			$output .= '<tr><td><input type="checkbox" class="checkitem" value="'.$row["pmid"].'" /></td>
			<td>'.$row["pmid"].'</td>
			<td>'.$row["groupname"].'</td>
			<td>'.$row["menu"].'</td>
			<td>'.$row["submenu"].'</td>
			<td>'.$permission.'</td>
			</tr>';	
		}
		echo $output;
	}
	else if($page == 'add'){
		$output='';
		$gid=mysqli_real_escape_string($connect,$_POST["ins_gid"]);
		$ins_menuid=$_POST["ins_menuid"];
		$menuid=mysqli_real_escape_string($connect,substr($ins_menuid,0,strpos($ins_menuid,":")));
		$submenuid=mysqli_real_escape_string($connect,substr($ins_menuid,strpos($ins_menuid,":")+1));
		$permission=mysqli_real_escape_string($connect,($_POST["ins_pm1"]=="on"?"1":"0").($_POST["ins_pm2"]=="on"?"1":"0").($_POST["ins_pm3"]=="on"?"1":"0").($_POST["ins_pm4"]=="on"?"1":"0"));
		
		$query="INSERT INTO permissions (gid,menuid,submenuid,permission) VALUES ($gid,$menuid,$submenuid,'$permission')";
		//echo $query;
		$result=mysqli_query($connect,$query);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
	}
?>