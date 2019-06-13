<?php
$connect=mysqli_connect("localhost","dev2","Map@2019","mapis");
if(!empty($_POST))
{
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
	/*	
	if(mysqli_query($connect,$query))
	{
		$output .= '<label class="text-success">Data Inserted</label>';
		$select_query="select uid,username,realname,mobile,email,lineid,u.gid,groupname from users u left join groups g on u.gid=g.gid";
		$result = mysqli_query($connect,$select_query);		
		if ($connect->connect_error) {
			die("Connect Error (" . $connect->connect_errno . ") ". $connect->connect_error);
		}
		
		
		/*$output .= '
		<table class="table table-bordered">
			<tr>
				<th></th><th>ID</th><th>User Name</th><th>Real Name</th><th>Contacts</th><th>Groups</th>
			</tr>
		';
		while($row=mysqli_fetch_array($result))
		{
			$output .='
			<tr>
				<td>
				<input type="checkbox" class="checkitem" value="';
			$output .= $row['uid'];	
			$output .='" />
				</td>
				<td>'.$row["uid"].'</td>
				<td>'.$row["username"].'</td>
				<td>'.$row["realname"].'</td>
				<td>'.$row["email"].','.$row["mobile"].','.$row["lineid"].' 
				
				</td>
				<td></td>
			</tr>	
			';
		}
		$output .= '</table>';
	
	}
	echo $output;
	*/
}
?>