<?php 
if(isset($_POST['sql'])){
$sql=$_POST['sql'];

$psql=$sql;
if($_POST['qtype']=="select"){
$result=mysqli_select($sql);
}else{
mysqli_q($sql);	
}
}
$title="Run SQL Query";
$path_header='templates/'.$template.'/header.php';
$path_content='templates/'.$template.'/sqlquery.php';
$path_footer='templates/'.$template.'/footer.php';
include($path_header);
include($path_content);
include($path_footer);

