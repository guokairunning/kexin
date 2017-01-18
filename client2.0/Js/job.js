$(document).ready(function() {
	   
        $(".saving img").click(function(){
        	 var osrc=$(".saving img").attr("src");
        	
	 	if(osrc=="../client/Images/saved.png"){
	 	 $(this).attr("src","../client/Images/before_save.png");
	 	}
	 	else if(osrc=="../client/Images/before_save.png"){
	 		$(this).attr("src","../client/Images/saved.png");
	 	}
	 
	 })
	   
	// $.ajax({
	// 	type:"GET";
	// 	url:"";
	// 	success:function(data){
	// 		var obj=eval("()")
	// 	}
	// })
})