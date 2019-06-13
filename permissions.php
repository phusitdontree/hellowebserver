<div class="container-fluid">
	<div class="row">
        <div class="col-md-4 p-3 small">
            <h3 class="align-middle">Permissions</h3>
        </div>
        <div class="col-md-8 p-3 small">
            <div class="btn-group float-right">
    			<button type="button" class="btn btn-outline-primary" name="addbtn" data-toggle="modal" data-target="#add_permission_Modal">Add</button>
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
		<div id="group_table">
			<table class="table table-hover table-fixed small">
			<thead><tr><th></th><th>PMID</th><th>Groupname</th><th>Menu</th><th>Submenu</th><th>Permissions</th></tr></thead>
			<tbody></tbody>
			</table>
		</div>
	</div>
</div>
	
<!-- Modal -->
<div class="modal fade" id="add_permission_Modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Permissions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="insert_form" >
      <div class="modal-body">
        
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

	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Menu : Submenu</label>
    	</div>
    	<div class="col-md-9">
    	<select class="form-control-sm" name="ins_menuid" id="ins_menuid">
	    <?php
	    	$result=$conn->query("SELECT submenuid,sm.menuid, m.menuname AS menu, sm.menuname AS submenu FROM submenu AS sm LEFT JOIN menu AS m ON sm.menuid = m.menuid");
	    	while($row=$result->fetch_assoc()){
	    		echo "<option value='".$row["menuid"].":".$row["submenuid"]."'>".$row["menu"]." : ".$row["submenu"]."</option>";	
	    	}
	    ?>
		</select>
		</div>
    </div>  

	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Permission</label>
    	</div>
    	<div class="col-md-9">
			<label class="form-control-sm" for="ins_pm1"><input type="checkbox"  name="ins_pm1" id="ins_pm1" /> Add</label>
			<label class="form-control-sm" for="ins_pm2"><input type="checkbox"  name="ins_pm2" id="ins_pm2" /> Edit</label>
			<label class="form-control-sm" for="ins_pm3"><input type="checkbox"  name="ins_pm3" id="ins_pm3" /> Delete</label>
			<label class="form-control-sm" for="ins_pm4"><input type="checkbox"  name="ins_pm4" id="ins_pm4" /> Special</label>
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

<div class="modal fade" id="edit_permission_Modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Permission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="edit_form">
      <div class="modal-body">
    	
    	
	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Group</label>
    	</div>
    	<div class="col-md-9">
    	<input type="hidden" name="edit_pmid" id="edit_pmid" />
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

	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Menu : Submenu</label>
    	</div>
    	<div class="col-md-9">
    	<select class="form-control-sm" name="edit_menuid" id="edit_menuid">
	    <?php
	    	$result=$conn->query("SELECT submenuid,sm.menuid, m.menuname AS menu, sm.menuname AS submenu FROM submenu AS sm LEFT JOIN menu AS m ON sm.menuid = m.menuid");
	    	while($row=$result->fetch_assoc()){
	    		echo "<option value='".$row["menuid"].":".$row["submenuid"]."'>".$row["menu"]." : ".$row["submenu"]."</option>";	
	    	}
	    ?>
		</select>
		</div>
    </div>  

	<div class="row">
    	<div class="col-md-3">
    	<label class="small">Permission</label>
    	</div>
    	<div class="col-md-9">
			<label class="form-control-sm" for="edit_pm1"><input type="checkbox"  name="edit_pm1" id="edit_pm1" /> Add</label>
			<label class="form-control-sm" for="edit_pm2"><input type="checkbox"  name="edit_pm2" id="edit_pm2" /> Edit</label>
			<label class="form-control-sm" for="edit_pm3"><input type="checkbox"  name="edit_pm3" id="edit_pm3" /> Delete</label>
			<label class="form-control-sm" for="edit_pm4"><input type="checkbox"  name="edit_pm4" id="edit_pm4" /> Special</label>
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
		url: "scripts/permissiondata.php?p=view",
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
		if($('groupname').val()=="")
		{
			alert("Groupname is required");
		}
		else
		{
			$.ajax({
				url: "scripts/permissiondata.php?p=add",
				method:"POST",
				data:$('#insert_form').serialize(),
				success:function(data)
				{
					//alert(data);
					//$('#insert_form')[0].reset();
					$('#add_permission_Modal').modal('hide');
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
			$('#edit_permission_Modal').modal('show');
			$.post('scripts/permissiondata.php?p=edit', {id: id}, function(data){
				//alert(data);
				
				res=data.split(',');
				$("#edit_pmid").val(res[0]);
				$("#edit_gid").val(res[1]);
				$("#edit_menuid").val(res[2]+":"+res[3]);
				if(res[4].charAt(0)=="1") $("#edit_pm1").prop("checked",true);
				if(res[4].charAt(1)=="1") $("#edit_pm2").prop("checked",true);
				if(res[4].charAt(2)=="1") $("#edit_pm3").prop("checked",true);
				if(res[4].charAt(3)=="1") $("#edit_pm4").prop("checked",true);
				//$("#edit_pm2").val(res[3]);
				//$("#edit_pm3").val(res[4]);
				//$("#edit_pm4").val(res[5]);
				
			});
		}
	
	
	});
	
	$('#delbtn').click(function(){
		var id = $('.checkitem:checked').map(function(){
			return $(this).val()
		}).get().join(' ');
		if(confirm("Delete ID# " + id)){
			$.post('scripts/permissiondata.php?p=del', {id: id}, function(data){
				viewdata();
			});
		}
	});
	
	$('#edit_form').on('submit',function(event){
		event.preventDefault();
		$.ajax({
			url: "scripts/permissiondata.php?p=save",
			method:"POST",
			data:$('#edit_form').serialize(),
			success:function(data)
			{
				alert(data);
				//$('#insert_form')[0].reset();
				if(data=='Record Saved'){
					$('#edit_permission_Modal').modal('hide');
					viewdata();
				}	
				
				//$('#user_table').html(data);
				//viewdata()
			}
		});

		
		
	}); 	
});


</script>