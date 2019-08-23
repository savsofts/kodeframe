<?php 
$table=$dbprefix."modules";
$sql=" select * from $table order by module_name asc ";
$table_data=mysqli_select($sql);
$table=$dbprefix."menu";
$sql=" select * from $table order by menu_id asc ";
$menu_data=mysqli_select($sql);
$table=$dbprefix."menu";
$menu_id=$_REQUEST['menu_id'];
$sql=" select * from $table where menu_id='$menu_id' ";
 
$result=mysqli_select($sql);
  
if(isset($_POST['menu_name'])){
	$menu_id=$_REQUEST['menu_id'];
	$menu_name=$_POST['menu_name'];
	$parent_menu_id=$_POST['parent_menu_id'];
	$order_by=$_POST['order_by'];
	$module_id=$_POST['module_id'];
	$sql=" update $table set menu_name='$menu_name',parent_menu_id='$parent_menu_id',order_by='$order_by',module_id='$module_id' where menu_id='$menu_id' ";
 	mysqli_insert($sql);
$_SESSION['success_msg']="Menu updated successfully!";
		redirect(site_url('menuList'));
exit;		
}


$title="Edit Menu";
$path_header='templates/'.$template.'/header.php';
$path_content='templates/'.$template.'/editMenu.php';
$path_footer='templates/'.$template.'/footer.php';
include($path_header);
include($path_content);
include($path_footer);

