<style>
.border{
	border:1px solid #dddddd;padding:10px;
}
</style>

<div class="row">
	 
	<div class="col-lg-12">
	
	<h2><?php echo $table_data[0]['module_name'];?> List</h2>
	<?php 
				  if(isset($_SESSION['error_msg'])){
					echo "<div class='alert alert-danger'>".$_SESSION['error_msg']."</div>";
					unset($_SESSION['error_msg']);
				  }
				  if(isset($_SESSION['success_msg'])){
					  
					echo "<div class='alert alert-success'>".$_SESSION['success_msg']."</div>";
					unset($_SESSION['success_msg']);
				  }
					?>
					
					
	<div style="text-align:right;padding-bottom:10px;">
	<a href="<?php echo site_url(array('page'=>'moduleAdd','table_name'=>$table_data[0]['table_name'],'module_id'=>$table_data[0]['module_id']));?>" class="btn btn-default hidden-print">Add new record</a> 
	<a href="<?php echo current_url();?>&export=csv" class="btn btn-default hidden-print">Export</a> 
	<a href="javascript:print();" class="btn btn-default hidden-print" >Print</a> 
	
	
	
	<button type="button" class="btn btn-default hidden-print" onClick="applyfilter();">Apply Filter</button>
	<span class="hidden-print">Show <input type="text" class="form-control" style="width:60px;display:inline;" value="<?php echo $nor;?>" onBlur="updaterows(this.value);"> Records 
<button type="button" class="btn btn-default hidden-print" onClick="changesize('m');">A-</button>
<button type="button" class="btn btn-default hidden-print" onClick="changesize('n');">A</button>
<button type="button" class="btn btn-default hidden-print" onClick="changesize('p');">A+</button>
	
	
	</span>

	</div>
	<?php 
	if(isset($psql) && isset($_REQUEST['showsql'])){
		?>
	<code><?php echo $psql;?></code>	
		<?php 
	}
	if(count($result)==0){
		?>
		<div class="alert alert-danger">No data found in selected module</div>
		<?php 
	}else{ ?>
	<table class="table table-hover table-bordered">
	<tr>
	<?php 
	$i=0;
	 
	foreach($result[0] as $k => $val){ 
	if(!is_numeric($k)){ 
	
	 
	if($show_hides[$i]=="show"){
	?>
	<th style="background:#eeeeee;"><?php echo str_replace('_',' ',ucfirst($k)); echo $show_hide[$k];?> 
	<span class="glyphicon glyphicon-search hidden-print" style="color:#666666;float:right;cursor:pointer;" aria-hidden="true" onClick="togglesearch('#search-<?php echo $k;?>');"></span>
	<span class="glyphicon glyphicon-triangle-bottom hidden-print" style="<?php if(isset($_REQUEST['orderby']) && $_REQUEST['orderby']==$k && $_REQUEST['order']=='DESC'){ ?>color:#c51e1e;<?php }else{ ?>color:#666666;<?php } ?>float:right;margin-right:4px;cursor:pointer;" aria-hidden="true" onClick="buildQueryUrl('<?php echo $k;?>','DESC');"></span>
	<span class="glyphicon glyphicon-triangle-top hidden-print" style="<?php if(isset($_REQUEST['orderby']) && $_REQUEST['orderby']==$k && $_REQUEST['order']=='ASC'){ ?>color:#c51e1e;<?php }else{ ?>color:#666666;<?php } ?>float:right;cursor:pointer;" aria-hidden="true" onClick="buildQueryUrl('<?php echo $k;?>','ASC');"></span>
	<div id="search-<?php echo $k;?>" style="<?php if(isset($filterArray[$k])){?> display:block;<?php }else{ ?> display:none;<?php } ?>" >
	<input type="text" class="search" value="<?php if(isset($filterArray[$k])){ echo $filterArrayVal[$k]; }?>" placeholder="Search" data-filter="<?php echo $table_name.".".$k;?>"   > 
	<select class="searchcon hidden-print" id="searchcon-<?php echo $table_name."_".$k;?>">
	<option value="EQUALTO">Equal</option>
	<option value="LIKE">Like</option>
	<option value="!EQUALTO">Not Equal</option>
	<option value=">EQUALTO">Greater and Equal</option>
	<option value="<EQUALTO">Less and Equal</option>
	<option value=">">Greater</option>
	<option value="<">Less</option>
	 </select>
	
	</div>
	</th>
	<?php }
$i+=1; 
	} } 
	if($table_data[0]['join_modules']=='No'){ ?>
	<th style="background:#eeeeee;" class="hidden-print">Action</th>
	<?php } ?>
	</tr>
	<?php 
	 $bg_color_code=explode(',',$table_data[0]['bg_color_code']);
	 $text_color_code=explode(',',$table_data[0]['text_color_code']);
	 $col_type=explode(',',$table_data[0]['col_type']);
	 
	foreach($result as $rk => $row){
		$i=0;
	?><tr><?php 
		foreach($row as $k => $val){ 
	if(!is_numeric($k)){ 

	if($show_hides[$i]=="show"){
		?>
<td style="background:<?php echo $bg_color_code[$i];?>;color:<?php echo $text_color_code[$i];?>" ><?php
if($col_type[$i-1] == "image"){ 
?>
<img src="<?php echo $val;?>" style="max-width:100px;max-height:100px;">
<?php 
}else{
 echo substr($val,0,100);
}
 
 ?></td>
	<?php 
	}
		$i+=1;
	}
	?>
	
	<?php 
		}
		
			if($table_data[0]['join_modules']=='No'){ ?>
		<td class="hidden-print">
<a href="<?php echo site_url(array('page'=>'moduleView','table_name'=>$table_data[0]['table_name'],'module_id'=>$table_data[0]['module_id']));?>&id=<?php echo $row['id'];?>" title="View entry"><span class="glyphicon glyphicon-folder-open hidden-print" ></span></a> &nbsp;&nbsp;
<a href="<?php echo site_url(array('page'=>'moduleEdit','table_name'=>$table_data[0]['table_name'],'module_id'=>$table_data[0]['module_id']));?>&id=<?php echo $row['id'];?>" title="Edit entry"><span class="glyphicon glyphicon-pencil hidden-print" ></span></a> &nbsp;&nbsp;
<a href="javascript:removeentry('<?php echo $row['id'];?>');" title="Remove entry"><span class="glyphicon glyphicon-trash hidden-print" ></span></a>


		</td>
		<?php 
			}
			?>
		</tr><?php 
	}
		?>
	</table>
	 
	 <?php 
	}
	
	$totalpage=0;
	$frac=$total_records[0]['norecords']/$nor;
	if($frac <= 0){
		$totalpage=1;
	}else{
		if(is_float($frac)){
			$totalpage=intval($frac)+1;
		}else{
			$totalpage=$frac;
		}		
	}
	  
	for($p=0; $p < $totalpage; $p++){
		$lim="limit=".$limit;
		$lim2="limit=".($p*$nor);
		 
		 ?>
	<a href="<?php echo str_replace($lim,$lim2,current_url());?>" class="btn btn-default hidden-print"><?php echo $p+1;?></a>	
		<?php
	}
	?>
	
	</div>
	 
	 
</div>
<input type="hidden" value="<?php echo strReplaceOrder(current_url());?>" id="current_url" >
<input type="hidden" value="<?php echo strReplaceFilter(current_url());?>" id="current_url_with_orderby" >
<div style="position:fixed;right:0px;bottom:2px;" class="hidden-print" ><a href="<?php echo current_url();?>&showsql=1"><span class="glyphicon glyphicon-qrcode" ></span></a></div>


<script>
function removeentry(id){
	if(confirm("Do you really want to remove this entry?")){
		window.location="<?php echo current_url();?>&remove="+id;
	}
}
</script>