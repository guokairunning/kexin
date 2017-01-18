<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>可辛工作</title>

    <link href="../client2.0/Css/index.css" rel="stylesheet">
    <link href="../client2.0/Css/job.css" rel="stylesheet">
     <link href="../client2.0/Css/register.css" rel="stylesheet">
     <link href="../client2.0/Css/login.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="../client2.0/Css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style=" background-color: #E3EEEC">

  <?php
      
       $num=0;
       //$user_id=$_SESSION['user_id'];
      
       $wkct_id=$_GET['id'];  
       $conn=new mysqli("localhost","root","199698","kx"); 
       $query = "set names utf8";
       $result = $conn->query($query);
       $sql="select * from work_content where wkct_id=$wkct_id";
       $result=$conn->query($sql);
       @$num=$result->num_rows;
       if($num){
          $row=$result->fetch_object();
          $wkct_id=$row->wkct_id;                              //id
          $wkct_title=$row->wkct_title;                        //标题
          $wkct_people_id=$row->wkct_people_id;                //发布人id
          $wkct_peopel_name=$row->wkct_peopel_name;            //发布人昵称   
          $wkct_place=$row->wkct_place;                        //工作地点
          $wkct_wktime=$row->wkct_wktime;                      //工作时间
          $wkct_createtime=$row->wkct_createtime;              //发布时间
          $wkct_phone=$row->wkct_phone;                        //联系电话
          $wkct_wages=$row->wkct_wages;                        //工资
          $wkct_context=$row->wkct_context;                    //详细信息
          $wkct_type=$row->wkct_type;                          //工作类型
          $wkct_inschool=$row->wkct_inschool;                  //是否在学校（0：校外 1：校内）
          $wkct_pic=$row->wkct_pic;                            //照片
          $wkct_hot=$row->wkct_hot;                            //hot度
          $wkct_off=$row->wkct_off;                            //是否下架（0：未下架 1：下架）
          $wkct_exp=$row->wkct_exp;                            //工作所需能力
       }
       else{
          echo "信息已删除!";
       }
  ?>
  


   
    <header class="ease" id="head">
		<!-- <a href="/">
		   <img class="logo ease" alt="" src="http://ershou.u.qiniudn.com/2shoujie_web_logo.png">
		</a> -->
		<div class="header-main center ease">
			<a class="slogan" href="../client2.0/index.php">
			   <h1 class="s-main"></h1>
			   <div class="s-submain"></div>
			   <img alt="西安邮电大学最安全方便的校园兼职市场" src="../client2.0/Images/0.png">
		    </a>
			<div class="search-box-wr ease">
				<form class="search-box center" method="get" action="">
					 <input class="search-submit" type="submit" value="搜索">
					<div class="input-wr">
					<span class="search-icon glyphicon glyphicon-search"></span>
					   <!-- <img class="search-icon" src="" > -->
						<div class="search-input">
						   <input id="keyword" type="text" placeholder="搜索你想做的校园兼职" x-webkit-speech="" name="keyword">  
						</div>

					</div>

				</form>
				
			</div>
		 <?php
       
        //session_unset();
        //登录时     
        if(isset($_SESSION['user_name'])){
          $user_name = $_SESSION['user_name'];
          if($_SESSION['user_type'] == 1){
            //学生时
            $href_user_info = "../client2.0/person_info.php";  
          }else{
            //老师时
            $href_user_info = "business_info.php";  
          }
          
          echo "  
                <div class='log-reg ease'>
                  <ul>
                   <li class='first'><a href='$href_user_info'>$user_name</a></li>&nbsp; ";
          if($_SESSION['user_type'] == 1){
            echo "
                   <li class='second' id='message_count'></li>";
              }     
          echo  "
                   <li class='third'><a href='../server/logout.php'>退出</a></li>
                  </ul>
                </div>
            ";
        }else{
        //未登录时
        echo "
              <div class='log-reg ease'>
              <div class='button' data-type='l' id='log_in'>登录</div>
              <div class='button' data-type='r' id='reg'>注册</div>
              </div>
            ";
        }


      ?>
         
		</div>
    </header>
    <div id="job_mainbody">
    	<div class="job_infor">
    		<div class="job_pic">
    			<img src="<?php  echo $wkct_pic; ?>" width="650px" height="700px">
                <div class="saving">
                    <img id="collect_img" src="../client2.0/Images/before_save.png">
                    <button id="yuyue">预约面试</button>
                </div>
    		</div>
    		<div class="infors">
    			<table> 
            <p style="display:none;" id="wkId"><?php echo $wkct_id; ?></p>
             <p style="display:none;" id="wkct_off"><?php echo $wkct_off; ?></p>
    				<tr>
    					<td class="wkct_id" colspan="2" id="wkTitle"><?php if($num) echo $wkct_title; else "信息已删除!"; ?></td>    <!--工作名称-->
    				</tr>
                    <tr>
                        <td class="wkct_peopel_name">发布人:</td>
                        <td class="wkct_peopel_namevalue" id="wkPeople"><?php if($num) echo $wkct_peopel_name; else "信息已删除!";?></td>   <!--发布人-->
                    </tr>
    				<tr >
    					<td class="infors_kinds">工作类型:</td>          <!--工作类型-->
    					<td class="infors_kinds_value"><?php if($num) echo $wkct_type; else "信息已删除!";?></td>
    				</tr>
    				<tr>
    					<td class="infors_address">工作地点:</td>       <!--工作地点-->
    					<td class="infors_address_value"><?php if($num) echo $wkct_place; else "信息已删除!";?></td>
    				</tr>
    				<tr>
    					<td class="infors_time">工作时间:</td>          <!--工作时间-->
    					<td class="infors_time_value"><?php if($num) echo $wkct_wktime; else "信息已删除!";?></td>
    				</tr>
    				<tr>
    					<td class="infors_money">工资薪酬:</td>         <!--工资薪酬-->
    					<td class="infors_money_value"><?php if($num) echo $wkct_wages; else "信息已删除!";?></td>
    				</tr>
    				<tr>
    					<td class="wkct_inschool">是否在校:</td>        <!--是否在校-->
    					<td class="wkct_inschool_value"><?php if($num){if($wkct_inschool) echo "校内";else echo "校外";} else "信息已删除!";?></td>
    				</tr>
    				<tr>
    					<td class="infors_phone">联系电话:</td>
    					<td class="infors_phone_value"><?php if($num) echo $wkct_phone; else "信息已删除!";?></td>
    				</tr>

    			</table>
    		</div>
    	</div>
    	<div id="job_detials">
        <div class="shangyinhao"><img src="../client2.0/Images/yinhao.png" width="120px" height="150px"></div>
         <div class="vlaue_detialss" id="wkct_context">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($num) echo $wkct_context; else "信息已删除!";?></div>  
      </div>
        <div id="messagess">
            <div class="message_board">   
                <p>评论</p>
                <div class="value_board">
                    <div class="board_pic"><img src="../client2.0/Images/you.jpg" width="80px" height="80px"></div>

                <form action="wkcm.php?id=<?php echo $wkct_id;?>" method="POST">      <!--提交评论在本页面-->
                    <input type="text" class="leave_meaaage" name="content">  
                    <input type="submit" class="public_message" value="发表">
                </form>
            
               </div>
              </div>
             <div class="messagessss">
            <div class="all_meaaage">评论板</div>




      
          <?php
                $sql_select="SELECT student_info.stu_head,wk_comment.wkcm_stu_id,wk_comment.wkcm_nickname,wk_comment.wkcm_content FROM student_info,wk_comment WHERE wkct_id=$wkct_id and wk_comment.wkcm_stu_id=student_info.stu_id";
                $result_se=$conn->query($sql_select);
                //var_dump($result_se);
               // echo $sql_select;
                if(@$result_se->num_rows){
                   while($row_re=$result_se->fetch_object()){
                    
                         echo '<div class="value_boards">
                            <div class="boards_pic">
                            <img src="'.$row_re->stu_head.'" width="100px" height="150px">
                            </div>
                            <div class="name_value_time">
                            <div class="name_time">
                                <p class="name_of_maker">'.$row_re->wkcm_nickname.'</p>
                            </div>
                            <div class="leaved_meaaage">'.$row_re->wkcm_content.'</div>
                            </div>
                            </div>';
                           
                         }
                   }
   ?>
     </div>

    <div class="mask"></div>
    <div  id="register_mask" ></div> 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../client2.0/Js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../client2.0/Js/bootstrap.min.js"></script>

     <!--  窗口滚动导航缩放-->
    <script type="text/javascript" src="../client2.0/Js/scroll.js"></script>
     <script type="text/javascript" src="../client2.0/Js/job.js"></script>
     <!-- 登录注册页面的显示隐藏  -->
   <script type="text/javascript" >
    $(function(){
        $('#reg').click(function(){
             $('.mask').css('display','block');
             $('#register_mask').css('display','block');
            $("#register_mask").load("../client2.0/register.html?t="+Math.random());
        })

         $('#log_in').click(function(){
             $('.mask').css('display','block');
             $('#register_mask').css('display','block');
            $("#register_mask").load("../client2.0/login.html?t="+Math.random());
        })

        $('.mask').click(function(){
             $('.mask').css('display','none');
             $('#register_mask').css('display','none');
        })
       
      })
   </script>


     <!-- 预约面试 -->
     <script type="text/javascript">
       $('#yuyue').click(function(){
        var title=$('#wkTitle').text();
        var id=$('#wkId').text();
        var people=$('#wkPeople').text();
           $.ajax({
               url:"../server/interview.php",
               type:"POST",
               data:{
                'func':'applyinterview',
                'wkct_id':id,
                'wkct_people_name':people,
                'wkct_title':title
               },
               success:function(data){
                 var obj=eval("("+data+")");
                 alert(obj.code+obj.msg)

               }

           })
      })
     </script>
      <!-- 收藏 -->
     <script type="text/javascript">
       $(function(){
        var wkId=$('#wkId').text();
        var title=$('#wkTitle').text();
        var text=$('#wkct_context').text();
        var off=$('#wkct_off').text();
            $.ajax({
              url:"collect.php",
              type:"POST",
              data:{
                'func':'havecoll',
                'wk_id':wkId
              },
              success:function(data)
              {
                 var obj=eval("("+data+")");
                 if(obj.code==1)
                 {
                  
                    $('#collect_img').attr('src','../client2.0/Images/saved.png');
                    $('#collect_img').click(function(){
                     
                        $.ajax({
                             url:"collect.php",
                             type:"POST",
                             data:{
                                'func':'delecollect',
                                 'wk_id':wkId
                             },
                             success:function(data){
                               $('#collect_img').attr('src','../client2.0/Images/before_save.png');
                                   var obj=eval("("+data+")");
                                   alert(obj.msg);
                                   window.location='job.php?id='+wkId;
                             }

                        })
                        
                    })
                 }
                 if(obj.code==0)
                 { 
                  $('#collect_img').attr('src','../client2.0/Images/before_save.png');
                     $('#collect_img').click(function(){
                      
                        $.ajax({
                             url:"collect.php",
                             type:"POST",
                             data:{
                                'func':'collect',
                                'wk_id':wkId,
                                'wkct_title':title,
                                'wkct_context':text,
                                'wkct_off':off
                             },
                             success:function(data){
                              $('#collect_img').attr('src','../client2.0/Images/saved.png');
                                   var obj=eval("("+data+")");
                                  alert(obj.msg);
                                  window.location='job.php?id='+wkId;
                             }

                        })

                    })
                 }
                  
              }

            })
       })
     </script>

     
  </body>
  <script type="text/javascript" src="../client2.0/Js/mess.js"></script>

</html>