$(document).ready(function() {
	  $("#person_con ul li").hover(function(){
	  	$(this).css("background-color","#64CBB3");
	  },function(){
        $(this).css("background-color","#fff"); 
	  })
	  
	  var $oli=$("#person_con ul li");
      $oli.click(function(){
           var index=$oli.index(this);
           $("#choice_card > div").eq(index).show().siblings().hide();             
      })

         
})