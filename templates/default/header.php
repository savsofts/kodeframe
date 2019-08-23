<html>
<head>
<title>
<?php if(isset($title)){ echo $title; }else{ echo 'Untitled';} ?>
</title>

 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  
  
<link rel="stylesheet" href="templates/default/bootstrap/css/bootstrap.min.css" crossorigin="anonymous">
<script src="templates/default/js/jquery.js"></script>
<script src="templates/default/js/basic.js?q=<?php echo time();?>"></script>
<script src="templates/default/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="templates/default/css/style.css" crossorigin="anonymous">

</head>
<body>
	 	<div class="row noprint" style="">
			  
			 <!-- navbar -->
			 
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">KodeFrame v0.1 beta</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
	   <li class=""><a href="<?php echo site_url('home');?>">Home</a></li>
       
	  <?php 
	  $table=$dbprefix."menu";

	  $sqli=" select * from $table where parent_menu_id='0' order by order_by asc ";
	  $main_menu=mysqli_select($sqli);
	   
	  foreach($main_menu as $mk => $mvalue){
		   
		if($mvalue['module_id']=="0"){
?>
     <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $mvalue['menu_name'];?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
		  
		 <?php 
		 $menu_id=$mvalue['menu_id'];
$sqli=" select * from $table where parent_menu_id='$menu_id' order by order_by asc ";
	  $sub_menu=mysqli_select($sqli);
	   
	  foreach($sub_menu as $sk => $smval){
	 
?>	  
		     <li><a href="<?php echo site_url(arrModuleDetail($smval['module_id'],$dbprefix));?>&limit=0"><?php echo $smval['menu_name'];?></a></li>
	<?php 
		}
?>		
		   
          </ul>
        </li>

		<?php }else{			?>
        <li class=""><a href="<?php echo site_url(arrModuleDetail($mvalue['module_id'],$dbprefix));?>&limit=0"><?php echo $mvalue['menu_name'];?></a></li>
        

		<?php 
		}
	  }
	  ?>
		 
		
		
		
      </ul>
	 
        <ul class="nav navbar-nav navbar-right">
        <?php 
		if($logged_in[0]['id']==1){
			?><li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setting <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('createModule');?>">Create New Module</a></li>
            <li><a href="<?php echo site_url('moduleListAll');?>">Module List</a></li>
            <li><a href="<?php echo site_url('sqlquery');?>">Run SQL Query</a></li>
            <li role="separator" class="divider"></li>
           <li><a href="<?php echo site_url('menuList');?>">Menu List</a></li>
           <li><a href="<?php echo site_url(array('page'=>'moduleList','table_name'=>$dbprefix.'user_group','module_id'=>'18'));?>&limit=0">User Group</a></li>
           <li><a href="<?php echo site_url(array('page'=>'moduleList','table_name'=>$dbprefix.'users','module_id'=>'16'));?>&limit=0">Account users</a></li>
           <li><a href="<?php echo site_url(array('page'=>'moduleList','table_name'=>$dbprefix.'logs','module_id'=>'26'));?>&limit=0">Logs</a></li>
          </ul>
        </li>
		<?php } ?>
        <li><a href="<?php echo site_url('logout');?>">Logout</a></li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



<!-- navbar ends --> 
 
</div>
	 	 	
		
		