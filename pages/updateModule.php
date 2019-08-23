<?php 
$table_name=$_POST['table_name'];
$module_name=$_POST['module_name'];
$table=$dbprefix."modules";
$sql=" select * from $table where table_name='$table_name' ";
 $module_id=$_REQUEST['module_id'];
 $sql=" select * from $table where module_id='$module_id' ";
$table_data=mysqli_select($sql);


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
		if($v!=""){
		$col_name[]=$v;
		}
		$col_value[]=str_replace(',',':',$_POST['default_value'][$k]);
		$col_type[]=$_POST['field_type'][$k];
		$validations[]=$_POST['validations'][$k];
		$show_hide[]=$_POST['show_hide'][$k];
		$joins[]=$_POST['joins'][$k];
		if(isset($_POST['old_fields'][$k])){
		if($_POST['old_fields'][$k]!=$v){
			$cv=$_POST['old_fields'][$k];
			
		$q[]=" CHANGE ".$cv." ".$v." ".$t;
		}
		}else{
			if($v!=""){
			$q[]=" add ".$v." ".$t;
			}
		}
			
	}
	foreach($_POST['old_fields'] as $ok => $ov){
	if(!isset($_POST['fields'][$ok])){
		$q[]=" DROP ".$ov;
	}	
	}
	$qq=implode(', ',$q);
	
	$sql="ALTER TABLE $table_name  
$qq  
";
 
	 if(mysqli_q($sql)){
	$dv['col_name']=implode(',',$col_name);
	$dv['bg_color_code']="#ffffff,".implode(',',$_POST['bg_color_code']);
	$dv['text_color_code']="#212121,".implode(',',$_POST['text_color_code']);
	$dv['col_type']=implode(',',$col_type);
	$dv['col_value']=implode(',',$col_value);
	$dv['validations']=implode(',',$validations);
	$dv['show_hide']=implode(',',$show_hide);
	$dv['tbl_joins']=implode(',',$joins);
	$dv['add_permission']=implode(',',$_POST['add_permission']);
	$dv['edit_permission']=implode(',',$_POST['edit_permission']);
	$dv['delete_permission']=implode(',',$_POST['delete_permission']);
	$dv['view_permission']=implode(',',$_POST['view_permission']);
	 $dv['export_permission']=implode(',',$_POST['export_permission']);
	$pd=prepareUpdate($dv);
 	$sql="update $table set $pd where module_id='$module_id' ";
	 
 mysqli_update($sql);
	$_SESSION['success_msg']="Module updated successfully!";
		redirect(site_url('createModule'));
	 }else{
		$_SESSION['error_msg']="Unable to update module";
		redirect(site_url('createModule'));
	 }
 