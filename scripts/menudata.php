<?php
	$connect=mysqli_connect("localhost","dev2","Map@2019","mapis");
	$connect->query("SET NAMES UTF8");
	$page = isset($_GET['p']) ? $_GET['p'] : '';
	if($page == 'save'){
		$output="";
		$menuid=$_POST["edit_menuid"];
		$menuname=mysqli_real_escape_string($connect,$_POST["edit_menuname"]);
		$description=mysqli_real_escape_string($connect,$_POST["edit_description"]);
		$q="update menu set menuname='$menuname',description='$description' where menuid=$menuid";
		$result=$connect->query($q);
		if ($connect->connect_error) $output="Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error;
		else $output="Record Saved";

		echo $output;
	}
	else if($page == 'del'){
		$myid = $_POST['id'];
		
		$id = str_replace(' ',',',$myid);
		$q="delete from menu where menuid in($id)";
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}	
	}
	else if($page == 'edit'){
		$myid = $_POST['id'];
		$q="select * from menu where menuid=".$myid;
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
		$output='';
		while($row=$result->fetch_assoc()){
			$output=$row["menuid"].",".$row["menuname"].",".$row["description"];
		}
		echo $output;
	}
	else if($page == 'view'){
		//$q="select uid,username,realname,mobile,email,lineid,u.gid,groupname from users u left join groups g on u.gid=g.gid";
		$q="SELECT menuid, menuname, description FROM `menu`";
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
		$output='';
		while($row=$result->fetch_assoc()){
			$permission="";
			$output .= '<tr><td><input type="checkbox" class="checkitem" value="'.$row["menuid"].'" /></td>
			<td>'.$row["menuid"].'</td>
			<td>'.$row["menuname"].'</td>
			<td>'.$row["description"].'</td>
			</tr>';	
		}
		echo $output;
	}
	else if($page == 'add'){
		$output='';
		$menuname=mysqli_real_escape_string($connect,$_POST["ins_menuname"]);
		$description=mysqli_real_escape_string($connect,$_POST["ins_description"]);		
		
		$query="INSERT INTO menu (menuname,description) VALUES ('$menuname','$description')";
		//echo $query;
		$result=mysqli_query($connect,$query);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
	}
?>