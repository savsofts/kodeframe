<?php 
$username=mysqli_real_escape_string($con,$_POST['username']);
$password=encPass(mysqli_real_escape_string($con,$_POST['password']));
$table1=$dbprefix."users";
$table2=$dbprefix."user_group";
$sql=" select * from $table1  where $table1.username='$username' and $table1.password='$password' ";
  
$res=mysqli_select($sql);
 
if(count($res) == 1){
	$id=$res['0']['id'];
 $token=$uid.rand(111111,999999).time();
 $sql=" update $table1 set connection_token='$token' where id='$id' ";
 
 mysqli_update($sql);
 redirect(site_url(array('page'=>'home','token'=>$token)));
}else{
	$_SESSION['error_msg']="Invalid Login";
	redirect(site_url('login'));
}
