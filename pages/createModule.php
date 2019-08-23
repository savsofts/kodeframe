<?php 
$table=$dbprefix."modules";
$sql=" select * from $table order by module_name asc ";
$table_data=mysqli_select($sql);


$title="Create New Module";
$path_header='templates/'.$template.'/header.php';
$path_content='templates/'.$template.'/createModule.php';
$path_footer='templates/'.$template.'/footer.php';
include($path_header);
include($path_content);
include($path_footer);

