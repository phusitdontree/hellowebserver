<div class="container-fluid">
	<div class="row">
        <div class="col-md-4 p-3 small">
            <h3 class="align-middle">Users</h3>
        </div>
        <div class="col-md-8 p-3 small">
            <div class="btn-group float-right">
    			<button type="button" class="btn btn-outline-primary" name="addbtn" data-toggle="modal" data-target="#add_user_Modal">Add</button>
				<button type="button" class="btn btn-outline-secondary" id="editbtn">Edit</button>
				<button type="button" class="btn btn-outline-danger" id="delbtn">Delete</button>
				<!--span class="align-middle" style="margin-left:10px;margin-right:8px;"> Search </span--> 
				<!--div class="btn-group" role="group">
	    		<button id="btnGroupDrop1" type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    </div>

	<div class="row  p-4">
		<div id="user_table">
			<table class="table table-hover table-fixed small">
			<thead><tr><th></th><th>ID</th><th>User Name</th><th>Real Name</th><th>Contacts</th><th>Groups</th></tr></thead>
			<tbody></tbody>
			</table>
		</div>
	</div>
</div>
	
<!-- Modal -->
<div class="modal fade" id="add_user_Modal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="insert_form" >
      <div class="modal-body">
        
    	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Username</label>
    	</div>
    	<div class="col-md-9">
    	<input type="text" name="ins_username" id="ins_username" class="form-control-sm" />
    	</div>
    	</div>
    	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Password</label>
    	</div>
    	<div class="col-md-9">
    	<input type="password" name="ins_password" id="ins_password" class="form-control-sm" />
    	</div>
    	</div>
    	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Real Name</label>
    	</div>
    	<div class="col-md-9">
    	<input type="text" name="ins_realname" id="ins_realname" class="form-control-sm" />
    	</div>
    	</div>
    	<div class="row">
    	<div class="col-md-3">
    	<label class="small">E-mail</label>
    	</div>
    	<div class="col-md-9">
    	<input type="text" name="ins_email" id="ins_email" class="form-control-sm" />
		</div>
    	</div>
    	
    	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Mobile</label>
    	</div>
    	<div class="col-md-9">
    	<input type="text" name="ins_mobile" id="ins_mobile" class="form-control-sm" />
    	</div>
    	</div>
    	 
    	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Line ID</label>
    	</div>
    	<div class="col-md-9">
    	<input type="text" name="ins_lineid" id="ins_lineid" class="form-control-sm" />
    	</div>
    	</div>
    	
    	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Group</label>
    	</div>
    	<div class="col-md-9">
    	<select class="form-control-sm" name="ins_gid" id="ins_gid">
	    <?php
	    	$result=$conn->query("select gid,groupname from groups");
	    	while($row=$result->fetch_assoc()){
	    		echo "<option value='".$row["gid"]."'>".$row["groupname"]."</option>";	
	    	}
	    ?>
		</select>
		</div>
    	</div>
   
      </div>
      <div class="modal-footer">
    	<div class="row text-center">
    	<div class="col-md-12">
    	<input type="submit" class="btn btn-primary" name="insert" id="insert" value="insert" class="form-control" />
    	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    	</div>
    	</div>
      </div>
	</form>
    </div>
  </div>
</div>

<div class="modal fade" id="edit_user_Modal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="edit_form">
      <div class="modal-body">
    	<div class="row">
    	<div class="col-md-4">
    	<label class="small">Username</label>
    	</div>
    	<div class="col-md-8">
    	<input type="hidden" name="edit_uid" id="edit_uid" />
    	<input type="text" name="edit_username" id="edit_username" class="form-control-sm" />
    	</div>
    	</div>
    	<div class="row">
    	<div class="col-md-4">
    	<label class="small">Current Password</label>
    	</div>
    	<div class="col-md-8">
    	<input type="password" name="old_password" id="old_password" class="form-control-sm" />
    	<input type="hidden" name="edit_password" id="edit_password" />
    	</div>
    	</div>
    	
    	<div class="row">
    	<div class="col-md-4">
    	<label class="small">New Password</label>
    	</div>
    	<div class="col-md-8">
    	<input type="password" name="new_password" id="new_password" class="form-control-sm" />
    	</div>
    	</div>
    	
    	<div class="row">
    	<div class="col-md-4">
    	<label class="small">Confirm Password</label>
    	</div>
    	<div class="col-md-8">
    	<input type="password" name="conf_password" id="conf_password" class="form-control-sm" />
    	</div>
    	</div>
    	
    	
    	<div class="row">
    	<div class="col-md-4">
    	<label class="small">Real Name</label>
    	</div>
    	<div class="col-md-8">
    	<input type="text" name="edit_realname" id="edit_realname" class="form-control-sm" />
    	</div>
    	</div>
    	<div class="row">
    	<div class="col-md-4">
    	<label class="small">E-mail</label>
    	</div>
    	<div class="col-md-8">
    	<input type="text" name="edit_email" id="edit_email" class="form-control-sm" />
		</div>
    	</div>
    	
    	<div class="row">
    	<div class="col-md-4">
    	<label class="small">Mobile</label>
    	</div>
    	<div class="col-md-8">
    	<input type="text" name="edit_mobile" id="edit_mobile" class="form-control-sm" />
    	</div>
    	</div>
    	 
    	<div class="row">
    	<div class="col-md-4">
    	<label class="small">Line ID</label>
    	</div>
    	<div class="col-md-8">
    	<input type="text" name="edit_lineid" id="edit_lineid" class="form-control-sm" />
    	</div>
    	</div>
    	
    	<div class="row">
    	<div class="col-md-4">
    	<label class="small">Group</label>
    	</div>
    	<div class="col-md-8">
    	<select class="form-control-sm" name="edit_gid" id="edit_gid">
	    <?php
	    	$result=$conn->query("select gid,groupname from groups");
	    	while($row=$result->fetch_assoc()){
	    		echo "<option value='".$row["gid"]."'>".$row["groupname"]."</option>";	
	    	}
	    ?>
		</select>
		</div>
    	</div>
        
       
      </div>
      <div class="modal-footer text-center">
        	<input type="submit" class="btn btn-primary" name="save" id="save" value="Save" class="form-control" />
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	</form> 
    </div>
  </div>
</div>

<script>
function viewdata(){
	
	$.ajax({
		url: "scripts/userdata.php?p=view",
		type:"GET",
		success:function(data)
		{
			
			$("tbody").html(data);
		}
	});

	
}

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
			$.ajax({
				url: "scripts/userdata.php?p=add",
				method:"POST",
				data:$('#insert_form').serialize(),
				success:function(data)
				{
					//alert(data);
					//$('#insert_form')[0].reset();
					$('#add_user_Modal').modal('hide');
					//$('#user_table').html(data);
					viewdata()
				}
			});
		}
	});	
	
	$('#editbtn').click(function(){
		var id = $('.checkitem:checked').map(function(){
			return $(this).val()
		}).get().join(',');
		if(id==''){
			alert("Please select a row to edit.");
		}
		else if(id.search(',')>=0){
			alert("Please select only one row.");
		}
		else{
			$('#edit_user_Modal').modal('show');
			
			$.post('scripts/userdata.php?p=edit', {id: id}, function(data){
				res=data.split(',');
				$("#edit_uid").val(res[0]);
				$("#edit_username").val(res[1]);
				$("#edit_password").val(res[2]);
				$("#edit_realname").val(res[3]);
				$("#edit_email").val(res[4]);
				$("#edit_mobile").val(res[5]);
				$("#edit_lineid").val(res[6]);
				$("#edit_gid").val(res[7]);
				
			});
		}
	
		
	});
	
	$('#delbtn').click(function(){
		var id = $('.checkitem:checked').map(function(){
			return $(this).val()
		}).get().join(' ');
		if(confirm("Delete ID# " + id)){
			$.post('scripts/userdata.php?p=del', {id: id}, function(data){
				viewdata();
			});
		}
	});
	
	$('#edit_form').on('submit',function(event){
		event.preventDefault();
		$.ajax({
			url: "scripts/userdata.php?p=save",
			method:"POST",
			data:$('#edit_form').serialize(),
			success:function(data)
			{
				alert(data);
				//$('#insert_form')[0].reset();
				if(data=='Record Saved'){
					$('#edit_user_Modal').modal('hide');
					viewdata();
				}	
				
				//$('#user_table').html(data);
				//viewdata()
			}
		});

		
		
	}); 	
});


</script>