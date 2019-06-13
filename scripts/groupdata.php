<?php
	//header("content-type:text/html;charset=utf-8");
	$connect=mysqli_connect("localhost","dev2","Map@2019","mapis");
	$connect->query("SET NAMES UTF8");
	$page = isset($_GET['p']) ? $_GET['p'] : '';
	if($page == 'save'){
		$gid=$_POST["edit_gid"];
		$groupname=$_POST["edit_groupname"];
		$q="update groups set groupname='$groupname'where gid=$gid";
		$result=$connect->query($q);
		if ($connect->connect_error) $output="Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error;
		else $output="Record Saved";
		
		echo $output;
	}
	else if($page == 'del'){
		$myid = $_POST['id'];
		
		$id = str_replace(' ',',',$myid);
		$q="delete from groups where gid in($id)";
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}	
	}
	else if($page == 'edit'){
		$myid = $_POST['id'];
		$q="select * from groups where gid=".$myid;
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
		$output='';
		while($row=$result->fetch_assoc()){
			$output.=$row["gid"].",";
			$output.=str_replace(",","&#44;",$row["groupname"]).",";
		}
		echo $output;
	}
	else if($page == 'view'){
		$q="select gid,groupname from groups";
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
		$output='';
		while($row=$result->fetch_assoc()){
			
			$output .= '<tr><td><input type="checkbox" class="checkitem" value="'.$row["gid"].'" /></td>
			<td>'.$row["gid"].'</td>
			<td>'.$row["groupname"].'</td>
			</tr>';	
		}
		echo $output;
	}
	else if($page == 'add'){
		$output='';
		$groupname=mysqli_real_escape_string($connect,$_POST["ins_groupname"]);
		
		$query="INSERT INTO groups(groupname) VALUES ('$groupname')";
		//echo $query;
		$result=mysqli_query($connect,$query);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
	}
?>