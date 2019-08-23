<?php 
 $table=$dbprefix."menu";
 if(isset($_REQUEST['remove'])){
	   $remove=$_REQUEST['remove'];
	  $sql=" delete from $table  where menu_id='$remove'  ";
		mysqli_q($sql);
	   
		
		
 }

 
$sql=" select A.menu_id,A.menu_name, B.menu_name as parent_menu from $table A LEFT Join $table B on A.parent_menu_id=B.menu_id  order by A.menu_id desc  ";
 
$table_data=mysqli_select($sql);
 
$title="Menu List";
$path_header='templates/'.$template.'/header.php';
$path_content='templates/'.$template.'/menuList.php';
$path_footer='templates/'.$template.'/footer.php';
include($path_header);
include($path_content);
include($path_footer);

