 $(function(){
        $('#reg').click(function(){
             $('.mask').css('display','block');
             $('#register_mask').css('display','block');
            $("#register_mask").load("./register.html?t="+Math.random());
        })

         $('#log_in').click(function(){
             $('.mask').css('display','block');
             $('#register_mask').css('display','block');
            $("#register_mask").load("./login.html?t="+Math.random());
        })

        $('.mask').click(function(){
             $('.mask').css('display','none');
             $('#register_mask').css('display','none');
        })
       
      })