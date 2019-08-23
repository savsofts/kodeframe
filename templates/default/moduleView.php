<style>
.border{
	border:1px solid #dddddd;padding:10px;
}
</style>

<div class="row">
	<div class="col-lg-1">
	
		
	
	</div>
	<div class="col-lg-6">
	
	<h2><?php echo $result[0][1];?></h2>
	<br><br>
	<table class="table">
	
  <?php 
 $col_names=explode(',',$table_data[0]['col_name']);
 $col_types=explode(',',$table_data[0]['col_type']);
 $col_values=explode(',',$table_data[0]['col_value']);
 foreach($col_names as $k => $col_name){
 ?>
 <tr><th><?php echo str_replace('_',' ',ucfirst($col_name));?></label></th>
 <td>
 <?php 
 if($col_types[$k]=="varchar(1000)"){
	 ?>
	<?php echo $result['0'][$col_name]; ?>  
	 
	 <?php 
 }
if($col_types[$k]=="date"){
	 ?>
	<?php echo $result['0'][$col_name]; ?>  
	 
	 <?php 
 }
  if($col_types[$k]=="image"){
	 ?>
	 <img src="<?php echo $result['0'][$col_name]; ?>" style="max-width:100px;max-height:100px;">  
	 
	 <?php 
 }
	 if($col_types[$k]=="int(11)"){
	 ?>
	 <?php echo $result['0'][$col_name]; ?> 
	 <?php 
 }	 
 if($col_types[$k]=="float"){
	 ?>
	 <?php echo $result['0'][$col_name]; ?>  
	 <?php 
 }
if($col_types[$k]=="text"){
	 ?>
	  <?php echo $result['0'][$col_name]; ?> 
	 <?php 
 }
if($col_types[$k]=="enum"){
	 ?>
	
	<?php echo $result['0'][$col_name];?>
	<?php 
	}
	if($col_types[$k]=="radio"){
	 ?>
	
	<?php echo $result['0'][$col_name];?>
	<?php 
	}
	if($col_types[$k]=="checkbox"){
	 ?>
	
	<?php echo $result['0'][$col_name];?>
	<?php 
	}
	if($col_types[$k]=="formula"){
	 ?>
	
	<?php echo $result['0'][$col_name];?>
	<?php 
	}
	?>
	 
	 
</td></tr>
 <?php 
 }
 ?>
 </table>
 <br><br>
 <div class="form-group">
 
  <a href="<?php echo site_url(array('page'=>'moduleList','table_name'=>$table_data[0]['table_name'],'module_id'=>$table_data[0]['module_id']));?>&limit=0" class="hidden-print" >List</a>
 &nbsp;&nbsp;
 <a href="javascript:print();" class="hidden-print">Print</a>
 
 </div>
 
 
 
 
 
	
	</div>
	 
	<div class="col-lg-4">
	
	</div>
	 
	<div class="col-lg-1">
	
		
	
	</div>
</div>
<input type="hidden" value="<?php echo strReplaceOrder(current_url());?>" id="current_url" >
<input type="hidden" value="<?php echo strReplaceFilter(current_url());?>" id="current_url_with_orderby" >
 