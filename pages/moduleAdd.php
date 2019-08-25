<?php 
$table_name=$_REQUEST['table_name'];
$table=$dbprefix."modules";
$sql=" select * from $table where table_name='$table_name' ";
$table_data=mysqli_select($sql);
$colname=$table_data[0]['col_name'];
$colname_arr=explode(',',$table_data[0]['col_name']);
$coltype_arr=explode(',',$table_data[0]['col_type']);
$joins=explode(',',$table_data[0]['tbl_joins']);
$col_names=explode(',',$colname);
 
if(isset($_POST[$col_names[0]])){
	$value=array();
	$ik=0;
	foreach($_POST as $k => $val){
		if($coltype_arr[$ik]=="password"){
			$value[]="'".encPass($val)."'";
		}else{
		if(is_array($val)){
		$value[]="'".implode(',',$val)."'";
		}else{
		$value[]="'".$val."'";
		}
		}
		$ik+=1;
	}
	$values=implode(',',$value);
	
	$filen="helpers/".$table_name.".php";
	if(file_exists($filen)){
		include_once($filen);
		$helpers=new helper_name();
		$helpers->pre_insert();
	}
	
	$sql="insert into $table_name ($colname) values($values)";
	$last_id=mysqli_insert($sql);
	 
	 
$filen="helpers/".$table_name.".php";
	if(file_exists($filen)){
		include_once($filen);
		$helpers=new helper_name();
		$helpers->post_insert();
	}
	
	
		$_SESSION['success_msg']="Entry added successfully!";
		redirect(site_url(array('page'=>'moduleAdd','table_name'=>$table_data[0]['table_name'],'module_id'=>$table_data[0]['module_id'])).'&limit=0');
		exit;
		
}

$joins_result=array();
 
foreach($joins as $jk => $jval){
	if($jval != ""){
		$tbj=explode('.',$jval);
		$table_name_j=$tbj[0];
		$sql=" select * from $table_name_j  ";
		 
		$joins_result[$tbj[1]]=mysqli_select($sql);
	}
}


$title="Add new record";
$path_header='templates/'.$template.'/header.php';
$filen='templates/'.$template.'/'.$table_name.'_Add.php';
	if(file_exists($filen)){
$path_content='templates/'.$template.'/'.$table_name.'_Add.php';
	}else{
$path_content='templates/'.$template.'/moduleAdd.php';
	}
$path_footer='templates/'.$template.'/footer.php';
include($path_header);
include($path_content);
include($path_footer);
