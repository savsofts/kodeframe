<?php 
$table1=$dbprefix."users";
$token=$_REQUEST['token'];
$token_new=$uid.rand(111111,999999).time();
 $sql=" update $table1 set connection_token='$token_new' where connection_token='$token' ";
   mysqli_update($sql);
   $t="&token=".$token;
 	 redirect(site_url_login());
exit;
 