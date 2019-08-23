<?php 
$table=$dbprefix."modules";
$primarytable=$_REQUEST['primarytable'];

$sql=" select * from $table where table_name!='$primarytable' ";
$table_datai=mysqli_select($sql);
$tid="col-".time();
?>
<select name="secondary_table[]" class="secondary_table" onChange="selectColom(this.value,'#<?php echo $tid;?>');" required >
<option value="">Select secondary table</option>
<?php
foreach($table_datai as $k => $val){
?>
<option value="<?php echo $val['table_name'];?>"><?php echo $val['module_name'];?></option>
<?php 
}
?>
</select>
<span id="<?php echo $tid;?>"></span>
<?php 

