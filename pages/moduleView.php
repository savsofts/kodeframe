<?php 
$table_name=$_REQUEST['table_name'];
$table=$dbprefix."modules";
$sql=" select * from $table where table_name='$table_name' ";
$table_data=mysqli_select($sql);
$colname=$table_data[0]['col_name'];
$col_names=explode(',',$colname);
$id=$_REQUEST['id'];
 

$sql=" select * from $table_name where id='$id' ";
$result=mysqli_select($sql);

$title="Edit record";
$path_header='templates/'.$template.'/header.php';
$path_content='templates/'.$template.'/moduleView.php';
$path_footer='templates/'.$template.'/footer.php';
include($path_header);
include($path_content);
include($path_footer);
