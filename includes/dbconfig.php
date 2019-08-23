<?php 





$con = mysqli_connect($hostname,$dbuser,$dbpassword,$dbname);
 

// Check connection
if (mysqli_connect_errno())
  {
  $ERROR="Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
function mysqli_select($query){
	$con=$GLOBALS['con'];
$result=mysqli_query($con,$query);
if (mysqli_num_rows($result) > 0) {
	 
   $nr=array();
    while($row = mysqli_fetch_array($result)) {
       $nr[]=$row;
    }
	return $nr;
} else {
	 
    return array();
}
	
}




function mysqli_insert($query){
	$con=$GLOBALS['con'];
if(mysqli_query($con,$query)){
return mysqli_insert_id($con);	
}else{
echo $query."<br>".mysqli_error($con);	
}
 	
}


function mysqli_update($query){
	$con=$GLOBALS['con'];
if(mysqli_query($con,$query)){
return true;	
}else{
echo $query."<br>".mysqli_error($con);	
}
 	
}


function mysqli_q($query){
	$con=$GLOBALS['con'];
if(mysqli_query($con,$query)){
return true;	
}else{
echo $query."<br>".mysqli_error($con);	
}
 	
}





function prepareInsertName($p){
	$n=array();
	foreach($p as $k => $v){
		$n[]="".$k."";
	}
	return implode(',',$n);
}


function prepareInsertValue($p){
	$n=array();
	foreach($p as $k => $v){
		if(is_array($v)){
			$v=implode(',',$v);
		}
		$n[]="'".$v."'";
	}
	return implode(',',$n);
}




function prepareUpdate($p){
	$n=array();
	foreach($p as $k => $v){
		if(is_array($v)){
			$v=implode(',',$v);
		}
		$n[]="".$k."='".$v."'";
	}
	return implode(',',$n);
}










