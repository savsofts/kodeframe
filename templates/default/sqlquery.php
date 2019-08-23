<style>
.border{
	border:1px solid #dddddd;padding:10px;
}
</style>

<div class="row">
	<div class="col-lg-1">
	
		
	
	</div>
	<div class="col-lg-10">
	
	<h2>SQL Query result</h2>
	<form method="post" action="<?php echo site_url('sqlquery');?>">
	<textarea name="sql"  class="form-control" placeholder="Type query here" ><?php echo $psql;?></textarea><select name="qtype" class="form-control" ><option value="select">Select data</option><option value="execute">Execute</option></select>
	<br> 
	<input type="submit" value="Run" class="btn btn-default">
	</form>
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
	
	<div style="text-align:right;padding-bottom:10px;">
	 <a href="<?php echo current_url();?>&export=csv" class="btn btn-default hidden-print">Export</a> 
	<a href="javascript:print();" class="btn btn-default hidden-print" >Print</a> 
	
	
	
	<button type="button" class="btn btn-default hidden-print" onClick="applyfilter();">Apply Filter</button>
	<span class="hidden-print">Show <input type="text" class="form-control" style="width:60px;display:inline;" value="<?php echo $nor;?>" onBlur="updaterows(this.value);"> Records 
<button type="button" class="btn btn-default hidden-print" onClick="changesize('m');">A-</button>
<button type="button" class="btn btn-default hidden-print" onClick="changesize('n');">A</button>
<button type="button" class="btn btn-default hidden-print" onClick="changesize('p');">A+</button>
	
	
	</span>

	</div>
	
	
	<table class="table table-hover table-bordered">
	<tr>
	<?php 
	foreach($result[0] as $k => $val){ 
	if(!is_numeric($k)){ ?>
	<th style="background:#eeeeee;"><?php echo str_replace('_',' ',ucfirst($k));?> 
	 </th>
	<?php } } ?>
	</tr>
	<?php 
	foreach($result as $rk => $row){
	?><tr><?php 
		foreach($row as $k => $val){ 
	if(!is_numeric($k)){ ?>
<td><?php echo $val;?></td>
	<?php 
	}
		}
		
		?></tr><?php 
	}
		?>
	</table>
	 
	 <?php 
	}
	?>
	</div>
	 
	<div class="col-lg-1">
	
		
	
	</div>
</div>

<div style="position:fixed;right:0px;bottom:2px;"><a href="<?php echo current_url();?>&showsql=1"><span class="glyphicon glyphicon-qrcode" ></span></a></div>
