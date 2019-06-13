<div class="container-fluid">
	<div class="row">
        <div class="col-md-4 p-3 small">
            <h3 class="align-middle">Menus</h3>
        </div>
        <div class="col-md-8 p-3 small">
            <div class="btn-group float-right">
    			<button type="button" class="btn btn-outline-primary" name="addbtn" data-toggle="modal" data-target="#add_menu_Modal">Add</button>
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
			<thead><tr><th></th><th>Menu ID</th><th>Menu Name</th><th>Description</th></tr></thead>
			<tbody></tbody>
			</table>
		</div>
	</div>
</div>
	
<!-- Modal -->
<div class="modal fade" id="add_menu_Modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="insert_form" >
      <div class="modal-body">
      	
        <div class="row">
    	<div class="col-md-3">
    	<label class="small">Menu Name</label>
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

<div class="modal fade" id="edit_menu_Modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
    	<div class="col-md-4">
    	<label class="small">Menu name</label>
    	</div>
    	<div class="col-md-8">
    	<input type="hidden" name="edit_menuid" id="edit_menuid" />
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
		url: "scripts/menudata.php?p=view",
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
		if($('menuname').val()=="")
		{
			alert("Menu Name is required");
		}
		else
		{
			$.ajax({
				url: "scripts/menudata.php?p=add",
				method:"POST",
				data:$('#insert_form').serialize(),
				success:function(data)
				{
					//alert(data);
					//$('#insert_form')[0].reset();
					$('#add_menu_Modal').modal('hide');
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
			$('#edit_menu_Modal').modal('show');
			$.post('scripts/menudata.php?p=edit', {id: id}, function(data){
				//alert(data);
				
				res=data.split(',');
				$("#edit_menuid").val(res[0]);
				$("#edit_menuname").val(res[1]);
				$("#edit_description").val(res[2]);

				
			});
		}
	
	
	});
	
	$('#delbtn').click(function(){
		var id = $('.checkitem:checked').map(function(){
			return $(this).val()
		}).get().join(' ');
		if(confirm("Delete ID# " + id)){
			$.post('scripts/menudata.php?p=del', {id: id}, function(data){
				viewdata();
			});
		}
	});
	
	$('#edit_form').on('submit',function(event){
		event.preventDefault();
		$.ajax({
			url: "scripts/menudata.php?p=save",
			method:"POST",
			data:$('#edit_form').serialize(),
			success:function(data)
			{
				alert(data);
				//$('#insert_form')[0].reset();
				if(data=='Record Saved'){
					$('#edit_menu_Modal').modal('hide');
					viewdata();
				}	
				
				//$('#user_table').html(data);
				//viewdata()
			}
		});

		
		
	}); 	
});


</script>