<?php 
session_start();
function verifyToken(){
	if(!isset($_REQUEST['token'])){
		exit('Login required to access this page');
	}
	if($_REQUEST['token']==""){
		exit('Login required to access this page');
	}
	$table1=$GLOBALS['dbprefix']."users";
	 $token=$_REQUEST['token'];
	$sql=" select * from $table1  where $table1.connection_token='$token' ";
	$res=mysqli_select($sql);
	if(count($res) == 1){
		
	}else{
	 	 redirect(site_url_login());
	exit('Invalid token');	
	}


}

function verifyPermissions(){
	if(!isset($_REQUEST['module_id']) && !isset($_REQUEST['token'])){
		if(!in_array($_REQUEST['page'],$GLOBALS['withoutLogin'])){
		 redirect(site_url_login());
		 exit('Invalid tokens');	
		}
	}
	
	
	if(isset($_REQUEST['module_id']) && !isset($_REQUEST['token'])){
		 redirect(site_url_login());
	 exit('Invalid token');	
	}
if(isset($_REQUEST['module_id']) && isset($_REQUEST['token'])){ 
$module_id=$_REQUEST['module_id'];
$page=$_REQUEST['page'];
$token=$_REQUEST['token'];
	$table1=$GLOBALS['dbprefix']."users";
	$table2=$GLOBALS['dbprefix']."modules";
	 $token=$_REQUEST['token'];
	$sql=" select * from $table1  where $table1.connection_token='$token' ";
	$res=mysqli_select($sql);
	$group_name=$res[0]['group_name'];
	 
	if(count($res) == 1){
		
	$sql=" select * from $table2  where $table2.module_id='$module_id' ";
	$modules_data=mysqli_select($sql);
		$perm=$modules_data[0];
		 if($page=="moduleList"){  
			if(!in_array($group_name,explode(',',$perm['view_permission']))){
			exit('Permission denied to access this page or perform action');	
			}
		} 
		if($page=="moduleAdd"){
			if(!in_array($group_name,explode(',',$perm['add_permission']))){
			exit('Permission denied to access this page or perform action');	
			}
		}
		 
		if($page=="moduleEdit"){ 
			if(!in_array($group_name,explode(',',$perm['edit_permission']))){
			exit('Permission denied to access this page or perform action');	
			}
		}
		if($page=="moduleList" && isset($_REQUEST['remove'])){
			if(!in_array($group_name,explode(',',$perm['delete_permission']))){
			exit('Permission denied to access this page or perform action');	
			}
		}
		if($page=="moduleList" && isset($_REQUEST['export'])){
			if(!in_array($group_name,explode(',',$perm['export_permission']))){
			exit('Permission denied to access this page or perform action');	
			}
		}
	}else{
		 redirect(site_url_login());
	 exit('Invalid token');	
	}
	return $res;
}else if(isset($_REQUEST['token']) && !isset($_REQUEST['module_id'])){
 	$table1=$GLOBALS['dbprefix']."users";
	  $token=$_REQUEST['token'];
	$sql=" select * from $table1  where $table1.connection_token='$token' ";
	$res=mysqli_select($sql);
	return $res;
} 	
}

function site_url($u){
	$imp=array();
	if(!is_array($u)){
	$imp[]='page='.$u;
	}else{
		foreach($u as $k => $v){
			$imp[]=$k.'='.$v;
		}
	}
	if(isset($_REQUEST['token'])){
		$imp[]='token='.$_REQUEST['token'];
	}
 
	return $GLOBALS['site_url'].'?'.implode('&',$imp);
}

function site_url_login(){
	return $GLOBALS['site_url'].'?page=login';
}

function redirect($u){
	header("location:$u");
}



function listmodule(){
	$dbprefix=$GLOBALS['dbprefix'];
	$table=$dbprefix."modules";
$sql=" select * from $table where show_hide_module='show' order by module_name asc ";

	return mysqli_select($sql);
}

function listgroup(){
	$dbprefix=$GLOBALS['dbprefix'];
	$table=$dbprefix."user_group";
$sql=" select * from $table  order by id  asc";

	return mysqli_select($sql);
}


function current_url(){
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
return $actual_link;
}


function strReplaceOrder($url){
	
	$str=explode('&',$url);
	$nstr[]=$str[0];
	foreach($str as $k => $val){
		if($k >= 1){
			$eval=explode('=',$val);
			if($eval[0]=="order" || $eval[0]=="orderby"){
				
			}else{
				$nstr[]=$val;
			}
				
			}		
	}
	return implode('&',$nstr);
	
}



function strReplaceFilter($url){
		$str=explode('&',$url);
	$nstr[]=$str[0];
	foreach($str as $k => $val){
		if($k >= 1){
			$eval=explode('=',$val);
			if(substr($eval[0],0,6)=="filter"){
				
			}else{
				$nstr[]=$val;
			}
				
			}		
	}
	return implode('&',$nstr);
	
}



function arrModuleDetail($module_id,$dbprefix){
	$table=$dbprefix."modules";
	$sqli=" select * from $table where module_id='$module_id'   ";
	  $module=mysqli_select($sqli);
	  
	  $n=array('page'=>'moduleList','table_name'=>$module[0]['table_name'],'module_id'=>$module_id);
	  return $n;
	  
	  
	
}





function addTableName($tablename,$col){
	$n=array();
	foreach(explode(',',$col) as $k => $v){
			$n[]=$tablename.".".$v;
	}
	return implode(',',$n);
}



function encPass($val){
	return md5($val);
}



function captureLogs(){
	
	$dbprefix=$GLOBALS['dbprefix'];
	$table=$dbprefix."logs";
	$ip_address=$_SERVER['REMOTE_ADDR'];
	
	$action_path="";
	if($_REQUEST['page']=="moduleAdd"){
	$action_path="Add ".str_replace('_',' ',str_replace('_table','',$_REQUEST['table_name']));	
	}else if($_REQUEST['page']=="moduleEdit"){
	$action_path="Edit ".str_replace('_',' ',str_replace('_table','',$_REQUEST['table_name']));	
	}else if($_REQUEST['page']=="moduleList" && isset($_REQUEST['remove'])){
	$action_path="Remove ".str_replace('_',' ',str_replace('_table','',$_REQUEST['table_name'])).' ('.$_REQUEST['remove'].')';	
	}else if($_REQUEST['page']=="moduleList"){
	$action_path="List ".str_replace('_',' ',str_replace('_table','',$_REQUEST['table_name']));	
	}else if($_REQUEST['page']=="moduleView"){
	$action_path="View ".str_replace('_',' ',str_replace('_table','',$_REQUEST['table_name']));	
	}else{
	$action_path="".$_REQUEST['page'];	
	}
	$action_description="URL: ".current_url();
	if(isset($_POST)){
		$action_description.="<br><u>POST Parameters:</u><br> ";
		foreach($_POST as $pk => $pval){
			if($pk=="password"){
		$action_description.=$pk." = *****".base64_encode($pval)."*****<br>";				
			}else{
		$action_description.=$pk." = ".$pval."<br>";
			}		
		}
	}
	if(isset($_REQUEST['token'])){
	$token=$_REQUEST['token'];
	$table1=$GLOBALS['dbprefix']."users";
	$token=$_REQUEST['token'];
	$sql=" select * from $table1  where $table1.connection_token='$token' ";
	$res=mysqli_select($sql);
	$logged_in_user=$res[0]['username'].' ('.$res[0]['id'].')';
	
	}else{
	$logged_in_user="No User Logged in";
	}
$sql=" insert into $table (ip_address,logged_in_user,action_path,action_description) values('$ip_address','$logged_in_user','$action_path','$action_description')";

	mysqli_insert($sql);
}
