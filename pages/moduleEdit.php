<?php 
$table_name=$_REQUEST['table_name'];
$table=$dbprefix."modules";
$sql=" select * from $table where table_name='$table_name' ";
$table_data=mysqli_select($sql);
$colname=$table_data[0]['col_name'];
$col_names=explode(',',$colname);
$joins=explode(',',$table_data[0]['tbl_joins']);
 


$id=$_REQUEST['id'];
if(isset($_POST[$col_names[0]])){
	$value=array();
	$i=0;
	foreach($_POST as $k => $val){
		if($val != ""){
		$value[]=$col_names[$i]."='".$val."'";
		 }
		$i+=1;
	}
	
	$filen="helpers/".$table_name.".php";
	if(file_exists($filen)){
		include_once($filen);
		$helpers=new helper_name();
		$helpers->pre_update();
	}
	
	
	$values=implode(',',$value);
	$sql="update $table_name set $values where id='$id' ";
	 
	mysqli_update($sql);
	
	$filen="helpers/".$table_name.".php";
	if(file_exists($filen)){
		include_once($filen);
		$helpers=new helper_name();
		$helpers->post_update();
	}
	
		$_SESSION['success_msg']="Entry updated successfully!";
		redirect(site_url(array('page'=>'moduleList','table_name'=>$table_data[0]['table_name'],'module_id'=>$table_data[0]['module_id'])).'&limit=0');
		exit;
		
}

$sql=" select * from $table_name where id='$id' ";
$result=mysqli_select($sql);


$joins_result=array();
 
foreach($joins as $jk => $jval){
	if($jval != ""){
		$tbj=explode('.',$jval);
		$table_name_j=$tbj[0];
		$sql=" select * from $table_name_j  ";
		 
		$joins_result[$tbj[1]]=mysqli_select($sql);
	}
}


$title="Edit record";
$path_header='templates/'.$template.'/header.php';
$filen='templates/'.$template.'/'.$table_name.'_Edit.php';
	if(file_exists($filen)){
$path_content='templates/'.$template.'/'.$table_name.'_Edit.php';
	}else{
$path_content='templates/'.$template.'/moduleEdit.php';
	}
	

$path_footer='templates/'.$template.'/footer.php';
include($path_header);
include($path_content);
include($path_footer);
