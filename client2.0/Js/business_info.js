$(document).ready(function() {
	  $("#person_con ul li").hover(function(){
	  	$(this).css("background-color","#64CBB3");
	  	$(this).css("cursor","pointer");
	  },function(){
        $(this).css("background-color","#fff"); 
	  })
	  
	  var $oli=$("#person_con ul li");
      $oli.click(function(){
           var index=$oli.index(this);
           $("#B_choice_card > div").eq(index).show().siblings().hide();             
      })

         
})