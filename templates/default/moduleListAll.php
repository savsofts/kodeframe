<style>
.border{
	border:1px solid #dddddd;padding:10px;
}
</style>

<div class="row">
	<div class="col-lg-1">
	
		
	
	</div>
	<div class="col-lg-10">
	
	<h2>Modules</h2>
	 
	<?php 
	 
	if(count($table_data)==0){
		?>
		<div class="alert alert-danger">No module created yet</div>
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
	
	<?php 
	if($row['module_delete_permission'] == "Yes"){ 
	if($row['join_modules']=="No"){
	?>
	<a href="<?php echo site_url(array('page'=>'editModule'));?>&module_id=<?php echo $row['module_id'];?>" title="Edit entry"><span class="glyphicon glyphicon-pencil hidden-print" ></span></a> &nbsp;&nbsp;
	<?php }else{ ?>
	<a href="#" title="Disabled"><span class="glyphicon glyphicon-pencil hidden-print" style="color:#dddddd;"></span></a> &nbsp;&nbsp;
	
	<?php } ?>
	<a href="javascript:removeentry('<?php echo $row['module_id'];?>','<?php echo $row['table_name'];?>');" title="Remove entry"><span class="glyphicon glyphicon-trash hidden-print" ></span></a>
	
 
	
	
	<?php } ?>
	&nbsp;&nbsp; <a href="javascript:truncatetable('<?php echo $row['module_id'];?>','<?php echo $row['table_name'];?>');" title="Truncate"><span class="glyphicon glyphicon-remove hidden-print" ></span></a>
	
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
function removeentry(id,table_name){
	if(confirm("Do you really want to remove this module and its all data?")){
		window.location="<?php echo current_url();?>&remove="+id+"&table_name="+table_name;
	}
}

function truncatetable(id,table_name){
	if(confirm("Do you really want to remove all date from module?")){
		window.location="<?php echo current_url();?>&removeAll="+id+"&table_name="+table_name;
	}
}
</script>