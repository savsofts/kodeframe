<style>
.border{
	border:1px solid #dddddd;padding:10px;
}
</style>

<div class="row">
	<div class="col-lg-1">
	
		
	
	</div>
	<div class="col-lg-8">
	
	<h2>Create new module</h2>
	
	<form method="post" action="<?php echo site_url('insertModule');?>">
	<?php 
				  if(isset($_SESSION['error_msg'])){
					echo "<div class='alert alert-danger'>".$_SESSION['error_msg']."</div>";
					unset($_SESSION['error_msg']);
				  }
				  if(isset($_SESSION['success_msg'])){
					  
					echo "<div class='alert alert-success'>".$_SESSION['success_msg']."</div>";
					unset($_SESSION['success_msg']);
				  }
					?>
					
	<div class="form-group">
	
	<label>Module Name</label>
	<input type="text" class="form-control" name="module_name" value="" placeholder="Module Name" onBlur="removespace2(this.value);" required >
	<input type="hidden" class="form-control" id="table_name" name="table_name" value=""  >
	</div>

	
		<div class="form-group">
	
	<label>Permissions</label><br>Select one or more groups for given action
	 <?php 
	 $listgroup=listgroup();
	 	
	?><br>
	<table><tr><td>
	 Add data 
	<select  class="form-control" name="add_permission[]" multiple >
	 <?php 
	foreach($listgroup as $gk => $grow){
	 	?>
		<option value="<?php echo $grow['group_name'];?>" <?php if($grow['id']==1){ echo 'selected';}?> ><?php echo $grow['group_name'];?></option>
		<?php 
	 
	}
	?>
	 </select>
	 
 
 </td><td>
	 Edit data 
	<select  class="form-control" name="edit_permission[]" multiple >
	 <?php 
	foreach($listgroup as $gk => $grow){
	 	?>
		<option value="<?php echo $grow['group_name'];?>"  <?php if($grow['id']==1){ echo 'selected';}?> ><?php echo $grow['group_name'];?></option>
		<?php 
	 
	}
	?>
	 </select>
	
</td><td>
	 Delete data 
	<select  class="form-control" name="delete_permission[]" multiple >
	 <?php 
	foreach($listgroup as $gk => $grow){
	 	?>
		<option value="<?php echo $grow['group_name'];?>"  <?php if($grow['id']==1){ echo 'selected';}?> ><?php echo $grow['group_name'];?></option>
		<?php 
	 
	}
	?>
	 </select>
	
	</td><td>
	 View data 
	<select  class="form-control" name="view_permission[]" multiple >
	 <?php 
	foreach($listgroup as $gk => $grow){
	 	?>
		<option value="<?php echo $grow['group_name'];?>"  <?php if($grow['id']==1){ echo 'selected';}?> ><?php echo $grow['group_name'];?></option>
		<?php 
	 
	}
	?>
	 </select>
	
	</td><td>
	 Export data 
	<select  class="form-control" name="export_permission[]" multiple >
	 <?php 
	foreach($listgroup as $gk => $grow){
	 	?>
		<option value="<?php echo $grow['group_name'];?>"  <?php if($grow['id']==1){ echo 'selected';}?> ><?php echo $grow['group_name'];?></option>
		<?php 
	 
	}
	?>
	 </select>
	
</td></tr></table>



	</div>

	 

	 

	<div id="field_container">
	<div id="sample">
	<div class="form-group border" style="background:#eeeeee;">
		<label>Field Name:</label>
		<input type="text" class="form-control" name="fields[]" value="" placeholder="Field Name" onBlur="removespace(this,this.value);"> <br>
	<div class="hidden_setting" style="display:none;">	
		<label>Default Value:</label>
		<input type="text" class="form-control" name="default_value[]" value="" placeholder="Default value"> <br>
			<label>Field type: </label>
		<select name="field_type[]">
		<option value="varchar(1000)">Text</option>
		<option value="password">Password</option>
		<option value="int(11)">Numeric</option>
		<option value="float">Numeric Float</option>
		<option value="text">Textbox</option>
		<option value="enum">Dropdown</option>
		<option value="checkbox">Checkbox</option>
		<option value="radio">Radio</option>
		<option value="image">Image</option>
		<option value="formula">Formula</option>
		<option value="date">Date/Time</option>
		</select> 
			<label>Validation: </label>
		<select name="validations[]">
		<option value='required'>Required</option>
		<option value=''>Optional</option>
		<option value='pattern="[0-9]+"'>Numeric</option>
		<option value='pattern="[A-Za-zSLASHs]+"'>Alpha</option>
		<option value='pattern="[A-Za-z0-9SLASHs]+"'>Alphanumeric</option>
		<option value='readonly'>Readonly</option>
		</select> 
		 
		<select name="show_hide[]">
		<option value="show">Show in list</option>
		<option value="hide">Hide in list</option>
		</select> 
		 <br><br>
		 	<label>Join module: </label>
		<select name="joins[]">	
		<option value="">Select</option>
		 <?php 
		 foreach($table_data as $k => $val){
			 $tb=$val['table_name'];
			 ?>
			 <optgroup label="<?php echo $val['module_name'];?>">
  <?php 
  $options=explode(',',$val['col_name']);
  foreach($options as $ok => $oval){
  ?>
					<option value="<?php echo $tb.".".$oval;?>"><?php echo $oval;?></option>	

					
			 <?php 
  }
  ?>
  </optgroup>	
  <?php 
		 }
		 
		 ?>
		 </select>
	</div>	
		 <span class="glyphicon glyphicon-trash
" onClick="removeEle(this);"  style="float:right;color:#666666;margin-right:10px;margin-top:-10px;" ></span> 
		 <span class="glyphicon glyphicon-cog
" onClick="advancesetting(this);"  style="float:right;color:#666666;margin-right:10px;margin-top:-10px;"></span> 
	</div>
	</div>
	
	</div>


<a name="down"></a>
	<div class="form-group">
<a href="javascript:addfield();" class="btn btn-default">Add more field</a>	
	 <input type="submit" value="Create module now" class="btn btn-primary">
	</div>
	
	</form>	
	
	
	<hr>
	<h2>Create module with joins</h2>
	<form method="post" action="<?php echo site_url('insertModule2');?>">
	
	<div class="form-group">
	
	<label>Module Name</label>
	<input type="text" class="form-control" name="module_name" value="" placeholder="Module Name" onBlur="removespace2(this.value);" required >
	<input type="hidden" class="form-control" id="table_name" name="table_name" value=""  >
	</div>
	
	
			<div class="form-group">
	
	<label>Permissions</label><br>Select one or more groups for given action
	 <?php 
	 $listgroup=listgroup();
	 	
	?><br>
	<table><tr><td>
	 Add data 
	<select  class="form-control" name="add_permission[]" multiple >
	 <?php 
	foreach($listgroup as $gk => $grow){
	 	?>
		<option value="<?php echo $grow['group_name'];?>" <?php if($grow['id']==1){ echo 'selected';}?> ><?php echo $grow['group_name'];?></option>
		<?php 
	 
	}
	?>
	 </select>
	 
 
 </td><td>
	 Edit data 
	<select  class="form-control" name="edit_permission[]" multiple >
	 <?php 
	foreach($listgroup as $gk => $grow){
	 	?>
		<option value="<?php echo $grow['group_name'];?>"  <?php if($grow['id']==1){ echo 'selected';}?> ><?php echo $grow['group_name'];?></option>
		<?php 
	 
	}
	?>
	 </select>
	
</td><td>
	 Delete data 
	<select  class="form-control" name="delete_permission[]" multiple >
	 <?php 
	foreach($listgroup as $gk => $grow){
	 	?>
		<option value="<?php echo $grow['group_name'];?>"  <?php if($grow['id']==1){ echo 'selected';}?> ><?php echo $grow['group_name'];?></option>
		<?php 
	 
	}
	?>
	 </select>
	
	</td><td>
	 View data 
	<select  class="form-control" name="view_permission[]" multiple >
	 <?php 
	foreach($listgroup as $gk => $grow){
	 	?>
		<option value="<?php echo $grow['group_name'];?>"  <?php if($grow['id']==1){ echo 'selected';}?> ><?php echo $grow['group_name'];?></option>
		<?php 
	 
	}
	?>
	 </select>
	
	</td><td>
	 Export data 
	<select  class="form-control" name="export_permission[]" multiple >
	 <?php 
	foreach($listgroup as $gk => $grow){
	 	?>
		<option value="<?php echo $grow['group_name'];?>"  <?php if($grow['id']==1){ echo 'selected';}?> ><?php echo $grow['group_name'];?></option>
		<?php 
	 
	}
	?>
	 </select>
	
</td></tr></table>



	</div>

	
	
	
	<div class="form-group">

	
	<select name="primary_table" class="primary_table" onChange="loadSecondaryTable(this.value);" required >	
		<option value="">Select primary table</option>
		 <?php 
		 foreach($table_data as $k => $val){
			 $tb=$val['table_name'];
			 ?>
  <option value="<?php echo $tb;?>"><?php echo $val['module_name'];?></option>	

					
			 
  <?php 
		 }
		 
		 ?>
		 </select>
		<br><br> 
	<span id="secondaryTable"></span>	 
	
	</div>
	<br><br>
	<a href="javascript:loadSecondaryTable2();" class="btn btn-default" id="morejoinbtn" style="display:none;">Add more join</a>	
 <br> <input type="submit" value="Create module now" class="btn btn-primary">
	
	</form>
	
	</div>
	<div class="col-lg-2">
	
		
	
	</div>
	<div class="col-lg-1">
	
		
	
	</div>
</div>



<script>
function loadSecondaryTable(primarytable){
	 
	var formData = {primarytable:primarytable};
	$.ajax({
		 type: "POST",
		 data : formData,
			url: "<?php echo site_url('secondaryTable');?>",
		success: function(data){
			
		 $('#secondaryTable').html(data);
			
		$('#morejoinbtn').css('display','block');
			
			},
		error: function(xhr,status,strErr){
			//alert(status);
			}	
		});
	
}


function loadSecondaryTable2(){
	 var primarytable=$('.primary_table').val();
	
	var formData = {primarytable:primarytable};
	$.ajax({
		 type: "POST",
		 data : formData,
			url: "<?php echo site_url('secondaryTable');?>",
		success: function(data){
			
		 $('#secondaryTable').append(data);
			
			},
		error: function(xhr,status,strErr){
			//alert(status);
			}	
		});
	
}


function selectColom(secondarytable,id){
	var primary_table=$('.primary_table').val();
	$('.secondary_table').each(function(){
		primary_table=primary_table+"-"+$(this).val();
	});
	
	
		var formData = {secondarytable:secondarytable,primary_table:primary_table};
	$.ajax({
		 type: "POST",
		 data : formData,
			url: "<?php echo site_url('selectColm');?>",
		success: function(data){
			
		 $(id).html(data);
			
			},
		error: function(xhr,status,strErr){
			//alert(status);
			}	
		});
}

</script>