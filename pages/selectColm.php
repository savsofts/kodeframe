<?php 
$table=$dbprefix."modules";
$primarytable=$_REQUEST['primary_table'];
$secondarytable=$_REQUEST['secondarytable'];
$pt=array();
foreach(explode('-',$primarytable) as $l => $v){
	$pt[]="'".$v."'";
}
$pt=implode(',',$pt);
$sql=" select * from $table where table_name in ($pt) ";
 
$table_datai=mysqli_select($sql);

$sql=" select * from $table where table_name='$secondarytable' ";
$table_data2=mysqli_select($sql);

?>
		<select name="column['<?php echo $secondarytable;?>'][]">	
		<option value="">Select coloumn</option>
		 <?php 
		 foreach($table_datai as $k => $val){
			 $tb=$val['table_name'];
			 ?>
			 <optgroup label="<?php echo $val['module_name'];?>">
  <?php 
  $options=explode(',',$val['col_name']);
  foreach($options as $ok => $oval){
  ?>
					<option value="<?php echo $tb.".".$oval;?>"><?php echo $tb.".".$oval;?></option>	

					
			 <?php 
  }
  ?>
  </optgroup>	
  <?php 
		 }
		 
		 ?>
		 </select> = 
		<select name="column['<?php echo $secondarytable;?>'][]">	
		<option value="">Select coloumn</option>
		 <?php 
		 foreach($table_data2 as $k => $val){
			 $tb=$val['table_name'];
			 ?>
			 <optgroup label="<?php echo $val['module_name'];?>">
  <?php 
  $options=explode(',',$val['col_name']);
  foreach($options as $ok => $oval){
  ?>
					<option value="<?php echo $tb.".".$oval;?>"><?php echo $tb.".".$oval;?></option>	

					
			 <?php 
  }
  ?>
  </optgroup>	
  <?php 
		 }
		 
		 ?>
		 </select>
		 <br><br>
<?php 

