<style>
.border{
	border:1px solid #dddddd;padding:10px;
}
</style>

<div class="row">
	<div class="col-lg-1">
	
		
	
	</div>
	<div class="col-lg-6">
	
	<h2>Edit module</h2>
	<?php 
	if($table_data[0]['join_modules']=="No"){
	?>
	<form method="post" action="<?php echo site_url('updateModule');?>&module_id=<?php echo $_REQUEST['module_id'];?>">
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
	<input type="text" class="form-control" name="module_name" value="<?php echo $table_data[0]['module_name'];?>" placeholder="Module Name" onBlur="removespace2(this.value);" readonly=readonly  >
	<input type="hidden" class="form-control" id="table_name" name="table_name" value="<?php echo $table_data[0]['table_name'];?>"  >
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
		<option value="<?php echo $grow['group_name'];?>" <?php   if(in_array($grow['group_name'],explode(',',$table_data[0]['add_permission']))){ echo 'selected';} ?> ><?php echo $grow['group_name'];?></option>
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
		<option value="<?php echo $grow['group_name'];?>"  <?php  if(in_array($grow['group_name'],explode(',',$table_data[0]['edit_permission']))){ echo 'selected';} ?> ><?php echo $grow['group_name'];?></option>
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
		<option value="<?php echo $grow['group_name'];?>"  <?php   if(in_array($grow['group_name'],explode(',',$table_data[0]['delete_permission']))){ echo 'selected';} ?> ><?php echo $grow['group_name'];?></option>
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
		<option value="<?php echo $grow['group_name'];?>"  <?php   if(in_array($grow['group_name'],explode(',',$table_data[0]['view_permission']))){ echo 'selected';}  ?> ><?php echo $grow['group_name'];?></option>
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
		<option value="<?php echo $grow['group_name'];?>"  <?php   if(in_array($grow['group_name'],explode(',',$table_data[0]['export_permission']))){ echo 'selected';} ?> ><?php echo $grow['group_name'];?></option>
		<?php 
	 
	}
	?>
	 </select>
	
</td></tr></table>



	</div>

	
	
<div id="field_container">
	
	 <?php 
	 $col_names=explode(',',$table_data[0]['col_name']);
	 $col_type=explode(',',$table_data[0]['col_type']);
	 $col_value=explode(',',$table_data[0]['col_value']);
	 $validations=explode(',',$table_data[0]['validations']);
	 $show_hide=explode(',',$table_data[0]['show_hide']);
	 $tbl_joins=explode(',',$table_data[0]['tbl_joins']); 
	 $bg_color_code=explode(',',$table_data[0]['bg_color_code']);
	 $text_color_code=explode(',',$table_data[0]['text_color_code']);
	 
	 foreach($col_names as $cki => $ckv){
	 ?>
	 <input type="hidden" name="old_fields[<?php echo $cki;?>]" value="<?php echo $ckv;?>">
		
	<div class="form-group border" style="background:#eeeeee;">
		<label>Field Name:</label>
		<input type="text" class="form-control" name="fields[<?php echo $cki;?>]" value="<?php echo $ckv;?>" placeholder="Field Name" onBlur="removespace(this,this.value);"> <br>
	<div class="hidden_setting" style="display:none;">	
		<label>Default Value:</label>
		<input type="text" class="form-control" name="default_value[<?php echo $cki;?>]" value="<?php echo $col_value[$cki];?>" placeholder="Default value"> <br>
			<label>Field type: </label>
		<select name="field_type[<?php echo $cki;?>]">
		<option value="varchar(1000)" <?php if($col_type[$cki]=="varchar(1000)"){ echo 'selected';}?> >Text</option>
		<option value="password" <?php if($col_type[$cki]=="password"){ echo 'selected';}?> >Password</option>
		<option value="int(11)" <?php if($col_type[$cki]=="int"){ echo 'selected';}?> >Numeric</option>
		<option value="float" <?php if($col_type[$cki]=="float"){ echo 'selected';}?> >Numeric Float</option>
		<option value="text" <?php if($col_type[$cki]=="text"){ echo 'selected';}?> >Textbox</option>
		<option value="enum" <?php if($col_type[$cki]=="enum"){ echo 'selected';}?> >Dropdown</option>
		<option value="checkbox" <?php if($col_type[$cki]=="checkbox"){ echo 'selected';}?> >Checkbox</option>
		<option value="radio" <?php if($col_type[$cki]=="radio"){ echo 'selected';}?> >Radio</option>
		<option value="image" <?php if($col_type[$cki]=="image"){ echo 'selected';}?> >Image</option>
		<option value="formula" <?php if($col_type[$cki]=="formula"){ echo 'selected';}?> >Formula</option>
		<option value="date" <?php if($col_type[$cki]=="date"){ echo 'selected';}?> >Date/Time</option>
		</select> 
			<label>Validation: </label>
		<select name="validations[<?php echo $cki;?>]">
		<option value='required'  <?php if($validations[$cki]=="required"){ echo 'selected';}?> >Required</option>
		<option value=''  <?php if($validations[$cki]==""){ echo 'selected';}?> >Optional</option>
		<option value='pattern="[0-9]+"'   <?php if($validations[$cki]=='pattern="[0-9]+"'){ echo 'selected';}?> >Numeric</option>
		<option value='pattern="[A-Za-zSLASHs]+"'   <?php if($validations[$cki]=='pattern="[A-Za-zSLASHs]+"'){ echo 'selected';}?> >Alpha</option>
		<option value='pattern="[A-Za-z0-9SLASHs]+"'   <?php if($validations[$cki]=='pattern="[A-Za-z0-9SLASHs]+"'){ echo 'selected';}?> >Alphanumeric</option>
		<option value='readonly' <?php if($validations[$cki]=='readonly'){ echo 'selected';}?>>Readonly</option>
		</select> 
		 
		<select name="show_hide[<?php echo $cki;?>]">
		<option value="show"  <?php if($show_hide[$cki]=="show"){ echo 'selected';}?> >Show in list</option>
		<option value="hide"   <?php if($show_hide[$cki]=="hide"){ echo 'selected';}?> >Hide in list</option>
		</select> 
		 <br><br>
		 	<label>Join module: </label>
		<select name="joins[<?php echo $cki;?>]">	
		<option value="">Select</option>
		 <?php 
		 foreach($table_datai as $k => $val){
			 $tb=$val['table_name'];
			 ?>
			 <optgroup label="<?php echo $val['module_name'];?>">
  <?php 
  $options=explode(',',$val['col_name']);
  foreach($options as $ok => $oval){
  ?>
					<option value="<?php echo $tb.".".$oval;?>" <?php $tk=$tb.".".$oval; if($joins[$cki]==$tk){ echo 'selected';}?> ><?php echo $oval;?></option>	

					
			 <?php 
  }
  ?>
  </optgroup>	
  <?php 
		 }
		 
		 ?>
		 </select>
		 
		 BG Color: <input type="color" name="bg_color_code[]" value="<?php if($bg_color_code[$cki+1]==""){ echo '#ffffff'; } echo $bg_color_code[$cki+1];?>">
		 Text Color: <input type="color" name="text_color_code[]" value="<?php  if($text_color_code[$cki+1]==""){ echo '#212121'; } echo $text_color_code[$cki+1];?>">
	</div>	
		<a href="#" onClick="removeEle(this);"  style="float:right;color:#666666;margin-right:10px;margin-top:-10px;" ><span class="glyphicon glyphicon-trash
"></span></a>
		<a href="#" onClick="advancesetting(this);"  style="float:right;color:#666666;margin-right:10px;margin-top:-10px;" ><span class="glyphicon glyphicon-cog
"></span></a>
	</div>

	 <?php 
	 }
	 ?>
	<div id="sample">
	<div class="form-group border" style="background:#eeeeee;">
		<label>Field Name:</label>
		<input type="text" class="form-control" name="fields[<?php echo $cki+1;?>]" value="" placeholder="Field Name" onBlur="removespace(this,this.value);"> <br>
	<div class="hidden_setting" style="display:none;">	
		<label>Default Value:</label>
		<input type="text" class="form-control" name="default_value[<?php echo $cki+1;?>]" value="" placeholder="Default value"> <br>
			<label>Field type: </label>
		<select name="field_type[<?php echo $cki+1;?>]">
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
		</select> 
			<label>Validation: </label>
		<select name="validations[<?php echo $cki+1;?>]">
		<option value='required'>Required</option>
		<option value=''>Optional</option>
		<option value='pattern="[0-9]+"'>Numeric</option>
		<option value='pattern="[A-Za-zSLASHs]+"'>Alpha</option>
		<option value='pattern="[A-Za-z0-9SLASHs]+"'>Alphanumeric</option>
		<option value='readonly'>Readonly</option>
		</select> 
		 
		<select name="show_hide[<?php echo $cki+1;?>]">
		<option value="show">Show in list</option>
		<option value="hide">Hide in list</option>
		</select> 
		 <br><br>
		 	<label>Join module: </label>
		<select name="joins[<?php echo $cki+1;?>]">	
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
		 		 BG Color: <input type="color" name="bg_color_code[]" value="#ffffff">
		 Text Color: <input type="color" name="text_color_code[]" value="#212121">

	</div>	
		 <span class="glyphicon glyphicon-trash
" onClick="removeEle(this);"  style="float:right;color:#666666;margin-right:10px;margin-top:-10px;"></span> 
	 <span class="glyphicon glyphicon-cog
" onClick="advancesetting(this);"  style="float:right;color:#666666;margin-right:10px;margin-top:-10px;"></span> 
	</div>
	</div>
	
	</div>


<a name="down"></a>
	<div class="form-group">
<!-- <a href="javascript:addfield();" class="btn btn-default">Add more field</a>	 --> 

	 <input type="submit" value="Update" class="btn btn-primary">
	</div>
	
	</form>	
	
	<?php 
	}
		if($table_data[0]['join_modules']=="Yes"){
		?>
		
		
		
		
		
		
		
		
		<?php } ?>
	</div>
	<div class="col-lg-4">
	
		
	
	</div>
	<div class="col-lg-1">
	
		
	
	</div>
</div>