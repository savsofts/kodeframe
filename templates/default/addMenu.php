<style>
.border{
	border:1px solid #dddddd;padding:10px;
}
</style>

<div class="row">
	<div class="col-lg-1">
	
		
	
	</div>
	<div class="col-lg-6">
	
	<h2>Create new menu</h2>
	
	<form method="post" action="<?php echo current_url();?>">
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
	
	<label>Menu Name</label>
	<input type="text" class="form-control" name="menu_name" value="" placeholder="Menu Name"   required >
	</div>

	 
	<div class="form-group">
	
	<label>Link to Module</label>
	<select name="module_id"><option value="0">No link</option>
	<?php 
	foreach($table_data as $k => $module){
		?>
	<option value="<?php echo $module['module_id'];?>"><?php echo $module['module_name'];?></option>	
		<?php 
	}
	?>
	</select>
	</div>

	<div class="form-group">
	
	<label>Parent Menu</label>
	<select name="parent_menu_id">
	<option value="0">No parent menu</option><?php 
	foreach($menu_data as $k => $menu){
		?>
	<option value="<?php echo $menu['menu_id'];?>"><?php echo $menu['menu_name'];?></option>	
		<?php 
	}
	?>
	</select>
	</div>

	 	<div class="form-group">
	
	<label>Order by</label>
	<input type="number" class="form-control" name="order_by" value="0"     required >
	</div>

	

	<div class="form-group">
	<input type="submit" class="btn btn-default">
	</div>

	
	
	
	
	
	
 
	
	</form>	
	
	 
	
	</div>
	<div class="col-lg-4">
	
		
	
	</div>
	<div class="col-lg-1">
	
		
	
	</div>
</div>


 