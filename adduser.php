<?php
$connect=mysqli_connect("localhost","Chaturaphat","marine1234","mapis");
if(!empty($_POST))
{
	$output='';
	$username=mysqli_real_escape_string($connect,$_POST["username"]);
	$realname=mysqli_real_escape_string($connect,$_POST["realname"]);
	$email=mysqli_real_escape_string($connect,$_POST["email"]);
	
	$query="INSERT INTO users(username,realname,email) VALUES ('$username','$realname','$email')";

	if(mysqli_query($connect,$query))
	{
		$output .= '<label class="text-success">Data Inserted</label>';
		$select_query="select uid,username,realname,mobile,email,lineid,u.gid,groupname from users u left join groups g on u.gid=g.gid";
		$result = mysqli_query($connect,$select_query);
		$output .= '
		<table class="table table-bordered">
			<tr>
				<th></th><th>ID</th><th>User Name</th><th>Real Name</th><th>Contacts</th><th>Groups</th>
			</tr>
		';
		while($row=mysqli_fetch_array($result))
		{
			$output .='
			<tr>
				<td><input type="checkbox"></th><td>'.$row["id"].'</td><td>'.$row["username"].'</td><td>'.$row["realname"].'</td><td>'.$row["email"].'</td><td></td>
			</tr>	
			';
		}
		$output .= '</table>';
	}
}
?>