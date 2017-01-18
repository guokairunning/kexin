$(window).load(function(){          /*验证登录表单*/
       $("#inputEmail3").blur(function(){       
             //验证用户名
             var omail_content=$("#inputEmail3").val();
             	if(omail_content==""){
             		$(".mail_content").css("display","block");
                                    }
                 else{
                 	$(".mail_content").css("display","none");
                 } 
                 if((omail_content!=""&&!/.+@.+\.[a-zA-Z]{2,4}$/.test(omail_content))){
             		$(".mail_shape").css("display","block");
                                    }
                 else{
                 	$(".mail_shape").css("display","none");
                 }                    
                               
         })
       $("#inputPassword3").blur(function(){       
             //验证密码
             var opassword_content=$("#inputPassword3").val();
             	if(opassword_content==""){
             		$(".password_content").css("display","block");
                                    }
                 else{
                 	$(".password_content").css("display","none");
                 }                        
         })
})