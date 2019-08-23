<?php 
$table=$dbprefix."modules";
$sql=" select * from $table order by module_name asc ";
$table_data=mysqli_select($sql);
$table=$dbprefix."menu";
$sql=" select * from $table order by menu_id asc ";
$menu_data=mysqli_select($sql);

if(isset($_POST['menu_name'])){
	$menu_name=$_POST['menu_name'];
	$parent_menu_id=$_POST['parent_menu_id'];
	$order_by=$_POST['order_by'];
	$module_id=$_POST['module_id'];
	$sql=" insert into $table (menu_name,parent_menu_id,order_by,module_id) values('$menu_name','$parent_menu_id','$order_by','$module_id')";
 	mysqli_insert($sql);
$_SESSION['success_msg']="Menu created successfully!";
		redirect(site_url('menuList'));
exit;		
}


$title="Create New Menu";
$path_header='templates/'.$template.'/header.php';
$path_content='templates/'.$template.'/addMenu.php';
$path_footer='templates/'.$template.'/footer.php';
include($path_header);
include($path_content);
include($path_footer);

