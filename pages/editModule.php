<?php 
$table=$dbprefix."modules";
$module_id=$_REQUEST['module_id'];
$sql=" select * from $table where module_id='$module_id' ";
$table_data=mysqli_select($sql);
$sql=" select * from $table order by module_name asc ";
$table_datai=mysqli_select($sql);


$title="Edit Module";
$path_header='templates/'.$template.'/header.php';
$path_content='templates/'.$template.'/editModule.php';
$path_footer='templates/'.$template.'/footer.php';
include($path_header);
include($path_content);
include($path_footer);

