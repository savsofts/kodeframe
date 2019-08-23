<?php 
error_reporting('E_ALL');
include('kodeframe_config.php');
include('includes/config.php');
include('includes/dbconfig.php');
include('includes/functions.php');
include('includes/logs.php');

 $logged_in=verifyPermissions();

if(isset($_REQUEST['page'])){
	$page=$_REQUEST['page'];
}else{
	$page="login";
}

if(!file_exists('pages/'.$page.'.php')){
$ERROR="Invalid file name";	
}

if(isset($ERROR)){
	include('pages/error.php');
}else{
	 	include('pages/'.$page.'.php');
	 
}

if($saveLogs==true){
captureLogs();
}

?>