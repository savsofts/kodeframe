function addfield(){
	var v=$('#sample').html();
	$('#field_container').append(v);
	window.location="#down";
}

function removeEle(e){
	  
	$($(e).parent()).remove();
}

function removespace(e,v){
	str = v.replace(/\s+/g, '_').toLowerCase();
	$(e).val(str);
}
function removespace2(v){
	str = v.replace(/\s+/g, '_').toLowerCase()+"_table";
	$('#table_name').val(str);
}


function togglesearch(id){
	$(id).toggle();
}

function buildQueryUrl(orderby,order){
	var vurl=$('#current_url').val()+"&orderby="+orderby+"&order="+order;
	window.location=vurl;
}


function applyfilter(){
 var filter="";
var i=1;
$('.search').each(function(){
	if($(this).val().trim() != ""){
		var d="#searchcon-"+$(this).data('filter').replace('.','_');
		var searchcon=$(d).val();
	 filter=filter+"&filter"+i+"="+$(this).data('filter')+","+$(this).val()+","+searchcon;
	
	i+=1;
	}
});

var vurl=$('#current_url_with_orderby').val()+""+filter;
console.log(vurl);
	 window.location=vurl;
	
}










function updaterows(n){
 var filter="";
var i=1;
$('.search').each(function(){
	if($(this).val().trim() != ""){
		var d="#searchcon-"+$(this).data('filter');
		var searchcon=$(d).val();
	 filter=filter+"&filter"+i+"="+$(this).data('filter')+","+$(this).val()+","+searchcon;
	
	i+=1;
	}
});

var vurl=$('#current_url_with_orderby').val()+""+filter+"&nor="+n;
console.log(vurl);
	 window.location=vurl;
		
	
}



function changesize(v){
	console.log(v);
	if(v=="m"){
	$('th').css('fontSize','11px');	
	$('td').css('fontSize','11px');	
		
	}else if(v=="p"){
	$('th').css('fontSize','15px');	
	$('td').css('fontSize','15px');	
		
	}else{
	$('th').css('fontSize','13px');	
	$('td').css('fontSize','13px');	
	}
}




function advancesetting(e){
	$($(e).parent()).find('.hidden_setting').toggle();
	
}






