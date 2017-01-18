$(function(){
          
        $.ajax({
          type:'GET',
          url:'../server/newmessage.php',
          success:function(data){
            var obj=eval("("+data+")");
            var mess_count=obj.data;
            if(mess_count==0)
            {
                 $('#message_count').css("display","none");
            }
            else
            {
               $('#message_count').html(mess_count);  
            }

          }
        })
      })