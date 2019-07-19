<div class="container-fluid">
	<div class="row">
        <div class="col-md-4 p-3 small">
            <h3 class="align-middle">Submenus</h3>
        </div>
        <div class="col-md-8 p-3 small">
            <div class="btn-group float-right">
    			<button type="button" class="btn btn-outline-primary" name="addbtn" data-toggle="modal" data-target="#add_submenu_Modal">Add</button>
				<button type="button" class="btn btn-outline-secondary" id="editbtn">Edit</button>
				<button type="button" class="btn btn-outline-danger" id="delbtn">Delete</button>
				<button type="button" class="btn btn-outline-secondary" id="permissionbtn">Permission</button>
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
		<div id="group_table">
			<table class="table table-hover table-fixed small">
			<thead><tr><th></th><th>Submenu ID</th><th>Menu</th><th>Submenu Name</th><th>Description</th><th>Link</th><th>Group Permission</th></tr></thead>
			<tbody id="mainbody"></tbody>
			</table>
		</div>
	</div>
</div>
	
<!-- Modal -->
<div class="modal fade" id="edit_permission_Modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Permission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="permission_form" >
      <div class="modal-body">
      	
      		<table class="table table-hover table-fixed small">
			<thead><tr><th></th><th>Group</th><th>Permission</th></tr></thead>
			<tbody id="permissionbody"></tbody>
			<tfoot>
				<tr><td>New</td><td>';
				<select class="form-control-sm" name="pmedit_gid" id="pmedit_gid">'
		<?php		
		$rs=$conn->query("select gid,groupname from groups");
	    while($row=$rs->fetch_assoc()){
	    	echo "<option value='".$row["gid"]."'>".$row["groupname"]."</option>";	
	    }
	    ?>
		</select>		
		</td><td>
			<input type="checkbox"  name="edit_pm1" id="edit_pm1" /> Add 
			<input type="checkbox"  name="edit_pm2" id="edit_pm2" /> Edit
			<input type="checkbox"  name="edit_pm3" id="edit_pm3" /> Delete
			<input type="checkbox"  name="edit_pm4" id="edit_pm4" /> Special
			<input type="hidden" name="pmsubmenuid" id="pmsubmenuid" value="'.$myid.'"/>
		</td></tr>
		
			</tfoot>
			</table>
      	
      </div>
      <div class="modal-footer">
    	<div class="row text-center">
    	<div class="col-md-12">
    	<input type="submit" class="btn btn-primary" name="addpermission" id="addpermission" value="Add New"  class="form-control" />
    	<input type="submit" class="btn btn-danger" name="delpermission" id="delpermission" value="Delete"  class="form-control" />
    	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    	</div>
    	</div>
      </div>
	</form>
    </div>
  </div>
</div>




<div class="modal fade" id="add_submenu_Modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Submenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="insert_form" >
      <div class="modal-body">
      	
      	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Menu</label>
    	</div>
    	<div class="col-md-9">
    	<select class="form-control-sm" name="ins_menuid" id="ins_menuid">
	    <?php
	    	$result=$conn->query("select menuid,menuname from menu");
	    	while($row=$result->fetch_assoc()){
	    		echo "<option value='".$row["menuid"]."'>".$row["menuname"]."</option>";	
	    	}
	    ?>
		</select>
		</div>
    	</div> 
      	
        <div class="row">
    	<div class="col-md-3">
    	<label class="small">Submenu Name</label>
    	</div>
    	<div class="col-md-9">
    	<input type="text" name="ins_menuname" id="ins_menuname" class="form-control-sm" />
    	</div>
    	</div>

    	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Description</label>
    	</div>
    	<div class="col-md-9">
    	<input type="text" name="ins_description" id="ins_description" class="form-control-sm" />
    	</div>
    	</div>
    	
    	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Link</label>
    	</div>
    	<div class="col-md-9">
    	<input type="text" name="ins_link" id="ins_link" class="form-control-sm" />
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

<div class="modal fade" id="edit_submenu_Modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Submenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="edit_form">
      <div class="modal-body">
      	
      	<div class="row">
    	<div class="col-md-4">
    	<label class="small">Menu</label>
    	</div>
    	<div class="col-md-8">
    	<input type="hidden" name="edit_submenuid" id="edit_submenuid" />
    	<select class="form-control-sm" name="edit_menuid" id="edit_menuid">
	    <?php
	    	$result=$conn->query("select menuid,menuname from menu");
	    	while($row=$result->fetch_assoc()){
	    		echo "<option value='".$row["menuid"]."'>".$row["menuname"]."</option>";	
	    	}
	    ?>
		</select>
		</div>
    	</div> 	
     
     <div class="row">
    	<div class="col-md-4">
    	<label class="small">Submenu name</label>
    	</div>
    	<div class="col-md-8">
    	<input type="text" name="edit_menuname" id="edit_menuname" class="form-control-sm" />
    	</div>
    	</div>  	
    	
		<div class="row">
    	<div class="col-md-4">
    	<label class="small">Description</label>
    	</div>
    	<div class="col-md-8">
    	<input type="text" name="edit_description" id="edit_description" class="form-control-sm" />
    	</div>
    	</div>  
    	
    	<div class="row">
    	<div class="col-md-4">
    	<label class="small">Link</label>
    	</div>
    	<div class="col-md-8">
    	<input type="text" name="edit_link" id="edit_link" class="form-control-sm" />
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
		url: "scripts/submenudata.php?p=view",
		type:"GET",
		success:function(data)
		{
			//alert(data);
			$("#mainbody").html(data);
		}
	});
}

$(document).ready(function(){
	$('#insert_form').on('submit',function(event){
		event.preventDefault();
		if($('menuname').val()=="")
		{
			alert("Submenu Name is required");
		}
		else
		{
			$.ajax({
				url: "scripts/submenudata.php?p=add",
				method:"POST",
				data:$('#insert_form').serialize(),
				success:function(data)
				{
					//alert(data);
					//$('#insert_form')[0].reset();
					$('#add_submenu_Modal').modal('hide');
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
			$('#edit_submenu_Modal').modal('show');
			$.post('scripts/submenudata.php?p=edit', {id: id}, function(data){
				//alert(data);
				
				res=data.split(',');
				$("#edit_submenuid").val(res[0]);
				$("#edit_menuid").val(res[1]);
				$("#edit_menuname").val(res[2]);
				$("#edit_description").val(res[3]);
				$("#edit_link").val(res[4]);
				
			});
		}
	
	
	});
	
	$('#delbtn').click(function(){
		var id = $('.checkitem:checked').map(function(){
			return $(this).val()
		}).get().join(' ');
		if(confirm("Delete ID# " + id)){
			$.post('scripts/submenudata.php?p=del', {id: id}, function(data){
				viewdata();
			});
		}
	});
	
	$('#edit_form').on('submit',function(event){
		event.preventDefault();
		$.ajax({
			url: "scripts/submenudata.php?p=save",
			method:"POST",
			data:$('#edit_form').serialize(),
			success:function(data)
			{
				alert(data);
				//$('#insert_form')[0].reset();
				if(data=='Record Saved'){
					$('#edit_submenu_Modal').modal('hide');
					viewdata();
				}	
				
				//$('#user_table').html(data);
				//viewdata()
			}
		});

		
		
	}); 	
	
	$('#permissionbtn').click(function(){
		var id = $('.checkitem:checked').map(function(){
			return $(this).val()
		}).get().join(',');
		if(id==''){
			alert("Please select a row.");
		}
		else if(id.search(',')>=0){
			alert("Please select only one row.");
		}
		else{

			$.post('scripts/submenudata.php?p=permission', {id: id}, function(data){
				$('#edit_permission_Modal').modal('show');
				$("#pmsubmenuid").val(id);
				$("#permissionbody").html(data);
			});
		}
	
	
	});
	
	$('#delpermission').click(function(){
		var id = $('.checkpm:checked').map(function(){
			return $(this).val()
		}).get().join(',');
		if(confirm("Delete ID# " + id)){
			$.post('scripts/submenudata.php?p=delpm', {id: id}, function(data){
				alert("permission deleted");
			});
			//	id=$("#pmsubmenuid").val();
			//	$.post('scripts/submenudata.php?p=permission', {id: id}, function(data){
			//		$("#permissionbody").html(data);
			//	});
		}
	});
	
	$('#addpermission').click(function(){
		
		id=$("#pmsubmenuid").val();
		pm="";
		if($("#edit_pm1").prop("checked")){ pm ="1"} else{ pm ="0"};
		if($("#edit_pm2").prop("checked")){ pm +="1"} else{ pm +="0"};
		if($("#edit_pm3").prop("checked")){ pm +="1"} else{ pm +="0"};
		if($("#edit_pm4").prop("checked")){ pm +="1"} else{ pm +="0"};
		//alert($("#edit_pm1").prop("checked"));
		gid=$("#pmedit_gid").val();
		$.post('scripts/submenudata.php?p=addpm', {id: id,pm: pm,gid: gid}, function(data){
			
			viewdata();

		});


		
	});
	


});


</script>