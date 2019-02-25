<?php
	$q="select uid,username,realname,mobile,email,lineid,u.gid,groupname from users u left join groups g on u.gid=g.gid";

	$result=$conn->query($q);
	if ($conn->connect_error) {
		die("Connect Error (" . $conn->connect_errno . ") ". $conn->connect_error);
	}
	?>
	<div class="container-fluid">
		
		<section class="row">
	        <div class="col-md-4 p-3 small">
	            <h3 class="align-middle">Users</h3>
	        </div>
	        <div class="col-md-8 p-3 small">
	            <div class="btn-group float-right">
	    			<button type="button" class="btn btn-outline-primary" name="addbtn" data-toggle="modal" data-target="#add_user_Modal">Add</button>
					<button type="button" class="btn btn-outline-secondary " name="editbtn">Edit</button>
					<button type="button" class="btn btn-outline-danger" name="delbtn">Delete</button>
					<!--span class="align-middle" style="margin-left:10px;margin-right:8px;"> Search </span--> 
					<div class="btn-group" role="group">
		    		<!--button id="btnGroupDrop1" type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    		Search
		    		</button>
		    		<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
		    			<a class="dropdown-item" href="#">User Name</a>
		    			<a class="dropdown-item" href="#">Groups</a>
		    		</div-->
		    		<div class="input-group">
    					<input type="text" class="form-control" placeholder="Search">
    					<div class="input-group-append">
    						<button class="btn btn-secondary" type="button">
        					<i class="fa fa-search"></i>
    						</button>
    					</div>
					</div>
		    	</div>
	        </div>
	    </section>

<section class="row  p-4">
	<div id="user_table">
	<table class="table table-hover table-fixed small">
		<thead><tr>
			<th></th><th>ID</th><th>User Name</th><th>Real Name</th><th>Contacts</th><th>Groups</th></tr></thead>
		<tbody>
	<?php
	while($row=$result->fetch_assoc()){
	?>
	<tr>
		<td><input type="checkbox"></td>
		<td><?=$row["uid"]?></td>
		<td><?=$row["username"]?></td>
		<td><?=$row["realname"]?></td>
		<td><?=$row["email"]?></td>
		<td><?=$row["groupname"]?></td>
	</tr>	
	<?php	
	}
	?>
	</tbody>
	</table>
	</div>
</section>
	</div>
	
	
	<!-- Modal -->
<div class="modal fade" id="add_user_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="insert_form">
        	<label>Username</label>
        	<input type="text" name="username" id="username" class="form-control" />
        	<br/>
        	<label>Real Name</label>
        	<input type="text" name="realname" id="realname" class="form-control" />
        	<br/>
        	<label>E-mail</label>
        	<input type="text" name="email" id="email" class="form-control" />
        	<br/> 
        	<input type="submit" class="btn btn-primary" name="insert" id="insert" value="insert" class="form-control" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	<?php
	$result->free();

?>

<script>
$(document).ready(function(){
	$('#insert_form').on('submit',function(event){
		event.preventDefault();
		if($('username').val()=="")
		{
			alert("Username is required");
		}
		else if($('realname').val()=="")
		{
			alert("Real Name is required");
		}
		else
		{
			alert("else");
			$.ajax({
				url: "adduser.php",
				method:"POST",
				data:$('#insert_form').serialize(),
				successs:function(data)
				{
					$('#insert_form')[0].reset();
					$('#add_user_Modal').modal('hide');
					$('#user_table').html(data);
				}
			});
		}
	});	
});
</script>