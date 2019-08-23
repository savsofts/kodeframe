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
	
	$module_name=$_POST['module_name'];
	$table_name=$_POST['primary_table'];
	$join_modules="Yes";
	$joined_tables=array();
	
	$jm=array();
	 foreach($_POST['secondary_table'] as $jk => $jv){
		 $joined_tables[]=$jv;
		foreach($_POST['column'] as $cjk =>$cjv){
			 
			if(str_replace("'","",$cjk)==$jv){
		$col=$cjv;
			  
	$jm[]=" LEFT JOIN ".$jv." on ".$col[0]."=".$col[1]." ";	
	
			}
		}
	}
	$joined_tables=implode(' ',$joined_tables);
	$extended_query=implode(' ',$jm);
	  
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
	
	 
 	$sql="insert into $table (module_name,table_name, col_name, col_type, col_value, validations, show_hide, tbl_joins, join_modules, joined_tables, extended_query, add_permission, edit_permission, delete_permission, view_permission, export_permission) 
	values('$module_name','$table_name','$col_name','$col_type','$col_value','$validations','$show_hide','$joins','$join_modules','$joined_tables','$extended_query','$add_permission','$edit_permission','$delete_permission','$view_permission','$export_permission') ";
 
 mysqli_insert($sql);
	$_SESSION['success_msg']="Module created successfully!";
		redirect(site_url('createModule'));
	}else{
		$_SESSION['error_msg']="Unable to create module";
		redirect(site_url('createModule'));
	}
}