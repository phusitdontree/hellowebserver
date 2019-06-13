<?php
	$connect=mysqli_connect("localhost","dev2","Map@2019","mapis");
	$connect->query("SET NAMES UTF8");
	$page = isset($_GET['p']) ? $_GET['p'] : '';
	if($page == 'save'){
		$uid=$_POST["edit_uid"];
		$username=$_POST["edit_username"];
		$password=$_POST["edit_password"];
		$oldpassword=$_POST["old_password"];
		$newpassword=$_POST["new_password"];
		$confpassword=$_POST["conf_password"];
		$realname=$_POST["edit_realname"];
		$email=$_POST["edit_email"];
		$mobile=$_POST["edit_mobile"];
		$lineid=$_POST["edit_lineid"];
		$gid=$_POST["edit_gid"];
		if(!empty($oldpassword)){
			if(md5($oldpassword)==$password){
				if(!empty($newpassword) && $newpassword==$confpassword){
					$q="update users set username='$username',password=md5('$newpassword'),realname='$realname',email='$email',mobile='$mobile',lineid='$lineid',gid=$gid where uid=$uid";
					$result=$connect->query($q);
					if ($connect->connect_error) $output="Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error;
					else $output="Record Saved";
			
				
				}
				else $output="Confirm Password Unmatched";			
				
			}
			else $output="Wrong Current Password";
		}
		else{
			$q="update users set username='$username',realname='$realname',email='$email',mobile='$mobile',lineid='$lineid',gid=$gid where uid=$uid";
			$result=$connect->query($q);
			if ($connect->connect_error) $output="Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error;
			else $output="Record Saved";

		}
		
		echo $output;
	}
	else if($page == 'del'){
		$myid = $_POST['id'];
		
		$id = str_replace(' ',',',$myid);
		$q="delete from users where uid in($id)";
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
			
		}	
	}
	else if($page == 'edit'){
		$myid = $_POST['id'];
		$q="select * from users where uid=".$myid;
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
		$output='';
		while($row=$result->fetch_assoc()){
			$output.=$row["uid"].",";
			$output.=str_replace(",","&#44;",$row["username"]).",";
			$output.=str_replace(",","&#44;",$row["password"]).",";
			$output.=str_replace(",","&#44;",$row["realname"]).",";
			$output.=str_replace(",","&#44;",$row["email"]).",";
			$output.=str_replace(",","&#44;",$row["mobile"]).",";
			$output.=str_replace(",","&#44;",$row["lineid"]).",";
			$output.=str_replace(",","&#44;",$row["gid"]);
		}
		echo $output;
	}
	else if($page == 'view'){
		$q="select uid,username,realname,mobile,email,lineid,u.gid,groupname from users u left join groups g on u.gid=g.gid";
		$result=$connect->query($q);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
		$output='';
		while($row=$result->fetch_assoc()){
			$contact=($row["email"]==""?"":"Email: ".$row["email"]."<br/>").
			($row["mobile"]==""?"":"Tel: ".$row["mobile"]."<br/>").
			($row["lineid"]==""?"":"Line ID: ".$row["lineid"]."<br/>");
			if(substr($contact,-5)=="<br/>") $contact=substr($contact,0,strlen($contact)-5);
			
			$output .= '<tr><td><input type="checkbox" class="checkitem" value="'.$row["uid"].'" /></td>
			<td>'.$row["uid"].'</td>
			<td>'.$row["username"].'</td>
			<td>'.$row["realname"].'</td>
			<td>'.$contact.'</td>
			<td>'.$row["groupname"].'</td>
			</tr>';	
		}
		echo $output;
	}
	else if($page == 'add'){
		$output='';
		$username=mysqli_real_escape_string($connect,$_POST["ins_username"]);
		$password=mysqli_real_escape_string($connect,$_POST["ins_password"]);
		$realname=mysqli_real_escape_string($connect,$_POST["ins_realname"]);
		$email=mysqli_real_escape_string($connect,$_POST["ins_email"]);
		$mobile=mysqli_real_escape_string($connect,$_POST["ins_mobile"]);
		$lineid=mysqli_real_escape_string($connect,$_POST["ins_lineid"]);
		$gid=mysqli_real_escape_string($connect,$_POST["ins_gid"]);
		
		$query="INSERT INTO users(username,password,realname,email,mobile,lineid,gid) VALUES ('$username',MD5('$password'),'$realname','$email','$mobile','$lineid',$gid)";
		//echo $query;
		$result=mysqli_query($connect,$query);
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
	}
?>