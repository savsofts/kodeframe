<?php 
$table_name=$_POST['table_name'];
$module_name=$_POST['module_name'];
$table=$dbprefix."modules";
$sql=" select * from $table where table_name='$table_name' ";
if(count(mysqli_select($sql)) >= 1){
		$_SESSION['error_msg']="Module name already exist";
		redirect(site_url('createModule'));
}else{
	$col_name=array();
	$col_type=array();
	$col_value=array();
	$validations=array();
	$show_hide=array();
	$joins=array();
	$show_hide[]="show";
	$q=array();
	foreach($_POST['fields'] as $k => $v){
		$df="";
		if($_POST['field_type'][$k]=="enum"){
			$df=array();
			foreach(explode(',',$_POST['default_value'][$k]) as $dk => $dv){
				$df[]="'".$dv."'";
			}
			$df=implode(',',$df);
			$t="ENUM(".$df.") NOT NULL ";
		}else if($_POST['field_type'][$k]=="password"){
			if($_POST['default_value'][$k] != ""){
				$df=" NOT NULL DEFAULT  '".$_POST['default_value'][$k]."'";
			}
			$t="varchar(1000) ".$df;
		}else if($_POST['field_type'][$k]=="checkbox"){
			if($_POST['default_value'][$k] != ""){
				$df=" NOT NULL DEFAULT  '".$_POST['default_value'][$k]."'";
			}
			$t="varchar(1000) ".$df;
		}else if($_POST['field_type'][$k]=="radio"){
			if($_POST['default_value'][$k] != ""){
				$df=" NOT NULL DEFAULT  '".$_POST['default_value'][$k]."'";
			}
			$t="varchar(1000) ".$df;
		}else if($_POST['field_type'][$k]=="formula"){
			if($_POST['default_value'][$k] != ""){
				$df=" NOT NULL DEFAULT  '".$_POST['default_value'][$k]."'";
			}
			$t="varchar(1000) ".$df;
		}else if($_POST['field_type'][$k]=="date"){
			if($_POST['default_value'][$k] != ""){
				$df=" NOT NULL DEFAULT  '".$_POST['default_value'][$k]."'";
			}
			$t="varchar(1000) ".$df;
		}else if($_POST['field_type'][$k]=="image"){
			if($_POST['default_value'][$k] != ""){
				$df=" NOT NULL DEFAULT  '".$_POST['default_value'][$k]."'";
			}
			$t="longtext ".$df;
		}else{
			
			if($_POST['default_value'][$k] != ""){
				$df=" NOT NULL DEFAULT  '".$_POST['default_value'][$k]."'";
			}
			$t=$_POST['field_type'][$k]." ".$df;
		}
		$col_name[]=$v;
		$col_value[]=str_replace(',',':',$_POST['default_value'][$k]);
		$col_type[]=$_POST['field_type'][$k];
		$validations[]=$_POST['validations'][$k];
		$show_hide[]=$_POST['show_hide'][$k];
		$joins[]=$_POST['joins'][$k];
		
		$q[]=$v." ".$t;
	}
	$qq=implode(', ',$q);
	
	$sql="CREATE TABLE $table_name (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
$qq ,
insert_date TIMESTAMP
)";

	if(mysqli_q($sql)){
	$col_name=implode(',',$col_name);
	$col_type=implode(',',$col_type);
	$col_value=implode(',',$col_value);
	$validations=implode(',',$validations);
	$show_hide=implode(',',$show_hide);
	$joins=implode(',',$joins);
	$add_permission=implode(',',$_POST['add_permission']);
	$edit_permission=implode(',',$_POST['edit_permission']);
	$delete_permission=implode(',',$_POST['delete_permission']);
	$view_permission=implode(',',$_POST['view_permission']);
	 $export_permission=implode(',',$_POST['export_permission']);
	
 	$sql="insert into $table (module_name,table_name, col_name, col_type, col_value, validations, show_hide, tbl_joins, add_permission, edit_permission, delete_permission, view_permission, export_permission) values('$module_name','$table_name','$col_name','$col_type','$col_value','$validations','$show_hide','$joins','$add_permission','$edit_permission','$delete_permission','$view_permission','$export_permission') ";
 
 mysqli_insert($sql);
 $sample_helper=file_get_contents('includes/sample_helper.txt');
 $class_filename=$table_name.".php";
 file_put_contents('helpers/'.$class_filename,$sample_helper);
 
	$_SESSION['success_msg']="Module created successfully!";
		redirect(site_url('createModule'));
	}else{
		$_SESSION['error_msg']="Unable to create module";
		redirect(site_url('createModule'));
	}
}