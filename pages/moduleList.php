<?php 
$table_name=$_REQUEST['table_name'];
$module_id=$_REQUEST['module_id'];
$table=$dbprefix."modules";
$sql=" select * from $table where table_name='$table_name' and module_id='$module_id'  ";
$table_data=mysqli_select($sql);
$table_data_2=$table_data;
$join_modules=$table_data[0]['join_modules'];
$joined_tables=$table_data[0]['joined_tables'];
$extended_query=$table_data[0]['extended_query'];
 
if($join_modules == "No"){
$col_name=explode(',',$table_data[0]['table_name'].'.id,'.addTableName($table_data[0]['table_name'],$table_data[0]['col_name']));
$show_hides=explode(',',$table_data[0]['show_hide']);
$joins=explode(',',$table_data[0]['tbl_joins']);

}else{
$sql=" select * from $table where table_name='$table_name' and module_id !='$module_id'  ";
$table_data=mysqli_select($sql);

$col_name=explode(',',$table_name.'.id,'.addTableName($table_data[0]['table_name'],$table_data[0]['col_name']));
 
$show_hides=explode(',',$table_data[0]['show_hide']);
$joins=explode(',',$table_data[0]['tbl_joins']);



foreach(explode(',',$joined_tables) as $jtblk => $jtblv){
 
$sql=" select * from $table where table_name='$jtblv' and module_id != '$module_id' ";
$table_data=mysqli_select($sql);

$col_name=array_merge($col_name,explode(',',addTableName($jtblv,$table_data[0]['col_name'])));
$show_hides=array_merge($show_hides,explode(',',$table_data[0]['show_hide']));
$joins=array_merge($joins,explode(',',$table_data[0]['tbl_joins']));


}

 


	
}

 
 if(isset($_REQUEST['remove'])){
	 
	$filen="helpers/".$table_name.".php";
	if(file_exists($filen)){
		include_once($filen);
		$helpers=new helper_name();
		$helpers->pre_delete();
	}
	
	$remove=$_REQUEST['remove'];
	$rsql=" delete from $table_name where id='$remove' ";
	mysqli_q($rsql);

	$filen="helpers/".$table_name.".php";
	if(file_exists($filen)){
		include_once($filen);
		$helpers=new helper_name();
		$helpers->post_delete();
	}

	
 }
 
if(isset($_REQUEST['limit'])){
	$limit=$_REQUEST['limit'];
}else{
$limit=0;
}
if(isset($_REQUEST['nor'])){
	$nor=$_REQUEST['nor'];
}
$orderb="";
if(isset($_REQUEST['orderby'])){
$orderb=" order by ".$_REQUEST['orderby']." ".$_REQUEST['order']." ";	
	
}else{
	$orderb=" order by id DESC";
}
$filterarr=array();
$filter="";
$filterArray=array();
$filterArrayVal=array();
$filterArrayCon=array();
for($i=1; $i<=100; $i++){
if(isset($_REQUEST['filter'.$i])){
	$d=explode(',',$_REQUEST['filter'.$i]);
	$searchcon=str_replace('EQUALTO','=',$d[2]);
$filterarr[]=$d[0]." ".$searchcon." '".urldecode($d[1])."'";
$filterArray[$d[0]]=$d[0];
$filterArrayVal[$d[0]]=urldecode($d[1]);
$filterArrayCon[$d[0]]=$searchcon;
}	
}
if(count($filterarr) >= 1){
	$filter=" where ".implode(' and ',$filterarr);
}

$joins_result=array();
$select=array();



foreach($col_name as $skk => $svv){
	if($svv != ""){
// $select[]=$table_name.".".$svv;	
$select[]=$svv;	
	}
}

foreach($joins as $jk => $jval){
	if($jval != ""){
		
	}
}
$select_i=implode(',',$select);

$sql=" select $select_i from $table_name  $extended_query $filter $orderb LIMIT $limit,$nor";
$psql=$sql;
 
$result=mysqli_select($sql);
$cid=$table_name.".id";
$sql2=" select count($cid) as norecords from $table_name  $extended_query $filter    ";
  
$total_records=mysqli_select($sql2);

if(isset($_REQUEST['export'])){

	$filename=date('d-m-Y',time()).'.csv';
	$fp = fopen('php://output', 'w');
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);

	$header=array();
	foreach($result[0] as $k => $val){ 
		if(!is_numeric($k)){ 
		   
		 $header[]=str_replace('_',' ',ucfirst($k));
		}
	}
	fputcsv($fp, $header);
		
	foreach($result as $rk => $row){
		$rowcsv=array();
	foreach($row as $k => $val){ 
			if(!is_numeric($k)){ 
			
			$rowcsv[]=$val;
		
			}
		}
		fputcsv($fp, $rowcsv);	
	}
	
	exit;
}
$table_data=$table_data_2;
$title="Module List";
$path_header='templates/'.$template.'/header.php';
$path_content='templates/'.$template.'/moduleList.php';
$path_footer='templates/'.$template.'/footer.php';
include($path_header);
include($path_content);
include($path_footer);

