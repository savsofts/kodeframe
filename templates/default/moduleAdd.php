<style>
.border{
	border:1px solid #dddddd;padding:10px;
}
</style>
<script>
var formula=new Array();
var fi=0;
</script>
<div class="row">
	<div class="col-lg-1">
	
		
	
	</div>
	<div class="col-lg-6">
	
	<h2>Add new record | <?php echo $table_data[0]['module_name'];?></h2>
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
					
	<br><br>
 <form method="post" action="<?php echo current_url();?>">
 <?php 
 $col_names=explode(',',$table_data[0]['col_name']);
 $col_types=explode(',',$table_data[0]['col_type']);
 $col_values=explode(',',$table_data[0]['col_value']);
 $validations=explode(',',$table_data[0]['validations']);
 foreach($col_names as $k => $col_name){
 ?>
 <div class="form-group">
 
 <label><?php echo str_replace('_',' ',ucfirst($col_name));?></label>
 
 <?php 
 
 if(!isset($joins_result[$col_name])){ 
 if($col_types[$k]=="varchar(1000)"){
	 ?>
	<input type="text" name="<?php echo $col_name;?>" value="<?php if(isset($col_values[$k])){ echo $col_values[$k]; } ?>" class="form-control formula_val <?php echo $col_name;?>" <?php echo str_replace("'","",str_replace('SLASH',"\'",$validations[$k]));?> > 
	 
	 <?php 
 }
if($col_types[$k]=="date"){
	 ?>
	<input type="date" name="<?php echo $col_name;?>" value="<?php if(isset($col_values[$k])){ echo $col_values[$k]; } ?>" class="form-control formula_val <?php echo $col_name;?>" <?php echo str_replace("'","",str_replace('SLASH',"\'",$validations[$k]));?> > 
	 
	 <?php 
 }
 if($col_types[$k]=="image"){
	 ?><br>
	<span class="glyphicon glyphicon-upload" style="font-size:24px;cursor:pointer;" onClick="showhidefileinput('.upload_img_<?php echo $col_name;?>','.webcam_img_<?php echo $col_name;?>','','<?php echo $col_name;?>');" title="Upload file"></span>  &nbsp;&nbsp;&nbsp;
	<span class="glyphicon glyphicon-camera" style="font-size:24px;cursor:pointer;" onClick="showhidefileinput('.webcam_img_<?php echo $col_name;?>','.upload_img_<?php echo $col_name;?>','.video_<?php echo $col_name;?>','<?php echo $col_name;?>');" title="Capture through webcam"></span>  
	<div class="upload_img_<?php echo $col_name;?>" style="display:none;">
	 <input id="inp_<?php echo $col_name;?>" type='file' class="btn btn-default" value="Attach Image">  
	</div>
 	<div class="webcam_img_<?php echo $col_name;?>"  style="display:none;">
	<table><tr><td> <video class="video_<?php echo $col_name;?>" style="width:250px;height:250px;">Video stream from web cam not available.</video>
	</td><td> <canvas class="canvas_<?php echo $col_name;?>" style="visibility:hidden;"  ></canvas>
	</td></tr></table>
	<br>
	 <button  type="button" class="btn btn-default videobtn_<?php echo $col_name;?>" style="display:none;" onClick="savephoto('<?php echo $col_name;?>');"><span class="glyphicon glyphicon-ok" style="font-size:24px;color:green;"></span> Capture Photo</button>
	 <button  type="button" class="btn btn-default retrybtn_<?php echo $col_name;?>"  style="display:none;"  onClick="startcam('.video_<?php echo $col_name;?>');"><span class="glyphicon glyphicon-repeat" style="font-size:24px;color:green;"></span> Retry</button>
	<hr></div>
 
 <input type="hidden" id="b64_<?php echo $col_name;?>" name="<?php echo $col_name;?>" > 
<span style='color:red' id='ierror_<?php echo $col_name;?>'></span>
<img id="img_<?php echo $col_name;?>" class='img-responsive' >

<script>

document.getElementById("inp_<?php echo $col_name;?>").addEventListener("change", function() {
  
  if (this.files && this.files[0]) {
	  console.log(this.files[0].size);
    if(this.files[0].size >= 1000000){
	$('#ierror_<?php echo $col_name;?>').html('Maximum file size allowed 1MB');	
	}else{
		$('#ierror_<?php echo $col_name;?>').html('');
    var FR= new FileReader();
    
    FR.addEventListener("load", function(e) {
      document.getElementById("img_<?php echo $col_name;?>").src       = e.target.result;
      document.getElementById("b64_<?php echo $col_name;?>").value = e.target.result;
    }); 
    
    FR.readAsDataURL( this.files[0] );
  }
  }
  
});	
	
</script>


	 
	  
	 <?php 
 }
if($col_types[$k]=="password"){
	 ?>
	<input type="password" name="<?php echo $col_name;?>" value="" class="form-control formula_val <?php echo $col_name;?>" <?php echo str_replace("'","",str_replace('SLASH',"\'",$validations[$k]));?> > 
	 
	 <?php 
 }
	 if($col_types[$k]=="int(11)"){
	 ?>
	<input type="number" name="<?php echo $col_name;?>" value="<?php if(isset($col_values[$k])){ echo $col_values[$k]; } ?>" class="form-control formula_val <?php echo $col_name;?>"  <?php echo str_replace("'","",str_replace('SLASH',"\'",$validations[$k]));?> > 
	 <?php 
 }	 
 if($col_types[$k]=="float"){
	 ?>
	<input type="text" name="<?php echo $col_name;?>" value="<?php if(isset($col_values[$k])){ echo $col_values[$k]; } ?>" class="form-control formula_val <?php echo $col_name;?>"  <?php echo str_replace("'","",str_replace('SLASH',"\'",$validations[$k]));?> > 
	 <?php 
 }
if($col_types[$k]=="text"){
	 ?>
	<textarea name="<?php echo $col_name;?>"  class="form-control formula_val <?php echo $col_name;?>" ><?php if(isset($col_values[$k])){ echo $col_values[$k]; } ?></textarea>
	 <?php 
 }
if($col_types[$k]=="enum"){
	 ?>
	<select name="<?php echo $col_name;?>"  class="form-control formula_val <?php echo $col_name;?>" >
	<?php 
	foreach(explode(':',$col_values[$k]) as $sk =>$sv){
		?>
	<option value="<?php echo $sv;?>"><?php echo $sv;?></option>	
		<?php 
	}
	?>
	</select>
	 <?php 
 }
 if($col_types[$k]=="radio"){
	 ?>
	
	<?php 
	foreach(explode(':',$col_values[$k]) as $sk =>$sv){
		?>
	<input type="radio"  name="<?php echo $col_name;?>"    value="<?php echo $sv;?>" class="formula_val <?php echo $col_name;?>" ><?php echo $sv;?> 
		<?php 
	}
	?>
	 
	 <?php 
 }
 if($col_types[$k]=="checkbox"){
	 ?>
	
	<?php 
	foreach(explode(':',$col_values[$k]) as $sk =>$sv){
		?>
	<input type="checkbox"  name="<?php echo $col_name;?>[]" class="formula_val <?php echo $col_name;?>"    value="<?php echo $sv;?>"><?php echo $sv;?> 
		<?php 
	}
	?>
	 
	 <?php 
 }
 if($col_types[$k]=="formula"){
	 ?>
	<input type="text" name="<?php echo $col_name;?>" data-formula="<?php echo $col_values[$k];?>" id="<?php echo $col_name;?>" value="0" class="form-control" readonly=readonly > 

<script>
formula[fi]="<?php echo $col_name;?>";
fi+=1;
</script>
	<?php 
 }
 ?>
 
 <?php 
 }else{
	 ?>
	 <select name="<?php echo $col_name;?>"  class="formula_val form-control" >
	 <?php 
	 foreach($joins_result[$col_name] as $jk => $jval){
		?>
	<option value="<?php echo $jval[$col_name];?>"><?php echo $jval[$col_name];?></option>	
		<?php 		 
	 }
	 ?>
	 </select>
	 <?php 
 }
 ?>
 </div>
 <?php 
 }
 ?>
 <br><br>
 <div class="form-group">
 
 <input type="submit" class="btn btn-default" value="Submit"> &nbsp;&nbsp;
 <a href="<?php echo site_url(array('page'=>'moduleList','table_name'=>$table_data[0]['table_name'],'module_id'=>$table_data[0]['module_id']));?>&limit=0">List</a>
 </div>
 
 </form>
 
 
 
	
	</div>
	 
	<div class="col-lg-4">
	
	</div>
	 
	<div class="col-lg-1">
	
		
	
	</div>
</div>
<input type="hidden" value="<?php echo strReplaceOrder(current_url());?>" id="current_url" >
<input type="hidden" value="<?php echo strReplaceFilter(current_url());?>" id="current_url_with_orderby" >
 
 
 
 <script>
$('.formula_val').on('change',function(){
	 
	 $(formula).each(function(index,value){
		 var v="#"+value;
		 var forml=$(v).data('formula');
		  $('.formula_val').each(function(){
			var g=$(this).attr('name'); 
			var c=parseFloat($(this).val()); 
			console.log(g+" "+c);
			 forml=forml.replace(g,c);
		 });
		var r=eval(forml.replace('=','')); 
		$(v).val(r);
	 });
});

var video="";
var cla_name="";
function showhidefileinput(show,hide,vclass,clname){
	cla_name=clname;
	$(show).css('display','block');
	$(hide).css('display','none');
	if(vclass != ""){

startcam(vclass)

	}
	
}


function startcam(vclass){
	var k=".videobtn_"+cla_name;
$(k).css('display','block');
var l=".retrybtn_"+cla_name;
$(l).css('display','none');
$(vclass).css('display','block');
			 video = document.querySelector(vclass);
		// Polyfill browser differences
navigator.getMedia = ( 
  navigator.getUserMedia ||
  navigator.webkitGetUserMedia ||
  navigator.mozGetUserMedia ||
  navigator.msGetUserMedia 
);  
  
// Start video stream  
navigator.getMedia( 
  {
    video: true,
    audio: false
  },
  doMediaStream,
  doMediaError
);

}

// Called when media stream is successful
// Starts watch for video element sizing
// Starts stream to video element
function doMediaStream( stream )
{  
  var url = null;

  // Debug
  console.log( 'Media stream linked.' );  
  
   
  // Polyfill browser differences
  if( navigator.mozGetUserMedia ) 
  {
    video.mozSrcObject = stream;
  } else {
   video.srcObject=stream;
  }
  
  // Start the stream
  video.play();  
}


function doMediaError(){
	
}


function savephoto(cl){
	var can=".canvas_"+cl;
	var canvas = document.querySelector(can);
	var context = canvas.getContext( '2d' );
// Draw video to canvas
context.drawImage( 
  video, 
  0, 
  0, 
  canvas.clientWidth, 
  canvas.clientHeight 
);
var d=canvas.toDataURL( 'image/png' );
// $(can).css('display','none');
var k=".videobtn_"+cla_name;
$(k).css('display','none');
var l=".retrybtn_"+cla_name;
$(l).css('display','block');


var cl2="#b64_"+cl;
$(cl2).val(d);

var cl3="#img_"+cl;
$(cl3).attr('src',d);

var cl4=".video_"+cla_name;
$(cl4).css('display','none');

}
  
</script>