$(document).ready(function() {
    
// 学生注册信息验证
    $('#stu_sub').click(function(){
          flag1=flag2=true;
          // 判断输入是否为空
            var aInput=$('#student-form').find('.val');
              for(var i=0;i<aInput.length;i++)
              {
               if(aInput.eq(i).val()=='')
               {
                flag1=false;
                break;
               }
              }
         // 验证密码的一致性
         value=$('#student-form .password').val();
         value1=$('#student-form .password1').val(); 
         value = $.trim(value); 
    	   value1 = $.trim(value1);
    	  if(value!=value1)
    	  {
    	  	
             flag2=false;
             value=value1=null;      
    	  }  


         stu_flag=flag1&&flag2; 
        if(!flag1)
        {
          alert('注册信息不能为空！');
          return false;
        }             
        if(flag1)
        {
            if(!flag2)
            {
                alert('两次密码输入不一致！');
                 return false;
                
            }
        }

    
     // if(stu_flag)
     //  {
        
     //  }
     //    else{
     //         // e.preventDefault();
     //    }
      //return stu_flag;
      alert(stu_flag)
      
   })


    // 教师注册信息验证
    /*$('#teacher_sub').click(function(){
          flag3=flag4=true;
          // 判断输入是否为空 
            var aInput=$('#teacher-form').find('.val');
              for(var i=0;i<aInput.length;i++)
              {
                
               if(aInput.eq(i).val()=='')
               {
                flag3=false;
                break;
               }
              }  

         // 验证密码的一致性
         var value=$('#teacher-form .password').val();
         var value1=$('#teacher-form .password1').val(); 
         value = $.trim(value); 
         value1 = $.trim(value1);
        if(value!=value1)
        {
          
             flag4=false;
             value=value1=null;      
        }  

        tec_flag=flag3&&flag4; 
        if(!flag3)
        {
          alert('注册信息不能为空！');
        }             
        if(flag3)
        {
            if(!flag4)
            {
                alert('两次密码输入不一致！');
            }
        }
     if(tec_flag)
      {
       // alert('注册成功');

      }
        else{
             // e.preventDefault();
        }
      return tec_flag;               
   })

    // $('#teacher_sub').click(function(){
  
        
    // })*/

    

});

   