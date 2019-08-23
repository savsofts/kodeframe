<?php 
 $table=$dbprefix."modules";
 if(isset($_REQUEST['table_name']) && isset($_REQUEST['remove'])){
	 $table_name=$_REQUEST['table_name'];
	 $remove=$_REQUEST['remove'];
	 $sql=" select module_id,module_name, table_name, module_delete_permission, join_modules from $table  where module_id='$remove'  ";
$table_data=mysqli_select($sql);
 
if($table_data[0]['module_delete_permission']=="Yes"){

	  $sql=" delete from $table  where module_id='$remove'  ";
		mysqli_q($sql);
	  $sql=" DROP TABLE IF EXISTS  $table_name    ";
	 
		mysqli_q($sql);
}
		
 }

 if(isset($_REQUEST['table_name']) && isset($_REQUEST['removeAll'])){
	 $table_name=$_REQUEST['table_name'];

	  $sql=" truncate $table_name    ";
		mysqli_q($sql);
 }
 
$sql=" select module_id,module_name, table_name, module_delete_permission, join_modules from $table  order by module_id desc  ";
$table_data=mysqli_select($sql);
 
$title="Module List";
$path_header='templates/'.$template.'/header.php';
$path_content='templates/'.$template.'/moduleListAll.php';
$path_footer='templates/'.$template.'/footer.php';
include($path_header);
include($path_content);
include($path_footer);

