<style>
.border{
	border:1px solid #dddddd;padding:10px;
}
</style>

<div class="row">
	<div class="col-lg-1">
	
		
	
	</div>
	<div class="col-lg-10">
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
	<h2>Menu</h2>
	 <a href="<?php echo site_url(array('page'=>'addMenu'));?>" class="btn btn-default hidden-print">Add new menu</a> 
	<br><br>
	<?php 
	 
	if(count($table_data)==0){
		?>
		<div class="alert alert-danger">No menu created yet</div>
		<?php 
	}else{ ?>
	<table class="table table-hover table-bordered">
	<tr>
	<?php 
	foreach($table_data[0] as $k => $val){ 
	if(!is_numeric($k)){ ?>
	<th style="background:#eeeeee;"><?php echo str_replace('_',' ',ucfirst($k));?> 
	 </th>
	<?php } } ?>
	<th style="background:#eeeeee;">Action</th>
	</tr>
	<?php 
	foreach($table_data as $rk => $row){
	?><tr><?php 
		foreach($row as $k => $val){ 
	if(!is_numeric($k)){ ?>
<td><?php echo $val;?></td>
	<?php 
	}
		}
		
		?>
	<td>
	<a href="<?php echo site_url(array('page'=>'editMenu'));?>&menu_id=<?php echo $row['menu_id'];?>" title="Edit entry"><span class="glyphicon glyphicon-pencil hidden-print" ></span></a> &nbsp;&nbsp;

	
	<a href="javascript:removeentry('<?php echo $row['menu_id'];?>','<?php echo $row['menu_name'];?>');" title="Remove entry"><span class="glyphicon glyphicon-trash hidden-print" ></span></a>

	</td>	
		</tr><?php 
	}
		?>
	</table>
	 
	 <?php 
	}
	?>
	</div>
	 
	<div class="col-lg-1">
	
		
	
	</div>
</div>

<div style="position:fixed;right:0px;bottom:2px;"><a href="<?php echo current_url();?>&showsql=1"><span class="glyphicon glyphicon-qrcode" ></span></a></div>


<script>
function removeentry(id,menu_name){
	if(confirm("Do you really want to remove this menu and all its sub menu?")){
		window.location="<?php echo current_url();?>&remove="+id+"&menu_name="+menu_name;
	}
}
</script>