<?php   
  //商家查看已发布的工作

  include_once "../server/api/function.php";
  session_start();
  $buss_id = $_SESSION['user_id'];
  $buss_nickname = $_SESSION['user_name'];

  if(!empty($buss_id)){
    $conn = mysqliConnect();//连接数据库
    $query = "set names utf8";
    $result = $conn->query($query);
    $query = "SELECT wkct_id,wkct_title,wkct_createtime,wkct_context,wkct_pic,wkct_off FROM work_content WHERE wkct_people_id='".$buss_id."'";
    $result = $conn->query($query);
    if($result){
      for($i = 0; $i < $result->num_rows; $i++){
        $work[] = $result->fetch_assoc();
      }
    }
       
    $query = "SELECT buss_email FROM buss_login WHERE buss_id='".$buss_id."'";
    $result_1 = $conn->query($query);

    if($result_1){
      for($i = 0; $i < $result_1->num_rows; $i++){
        $email[] = $result_1->fetch_assoc();
      }
    }
  }
  else{
  //   header("location: ----");
  }
  ?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>可辛商家中心</title>

    <link href="Css/index.css" rel="stylesheet">
    
    <link href="Css/buss_info.css" rel="stylesheet">
    <link href="Css/bussiness_info.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="Css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <!-- header头部搜索  注册  登录 -->
    <header class="ease" id="head">
		<a href="index.php">
		   <img class="logo ease" alt="" src="Images/1.png">
		</a>
		<div class="header-main center ease">
			<a class="slogan" href="index.php">
			   <h1 class="s-main"></h1>
			   <div class="s-submain"></div>
			   <img alt="西安邮电大学最安全方便的校园兼职市场" src="Images/0.png">
		    </a>
			<div class="search-box-wr ease">
				<form class="search-box center" method="get" action="search.php">
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
            $href_user_info = "./person_info.php";  
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
    

    <div id="con_box">
       <!-- 侧边导航栏 -->
       <div id="navbar" class="ease" >
        <div id="position">
          <span class="glyphicon glyphicon-map-marker"></span>
          <p><a href="#">西安邮大学</a></p>
        </div>
       	  <ul id="menu">
          <li><a href='search.php?type=t1'> 打扫卫生</a></li>
          <li><a href="search.php?type=t2"> 图书馆助理</a></li>
          <li><a href="search.php?type=t3">餐厅助理</a></li>
          <li><a href="search.php?type=t4">校园代理</a></li>
          <li><a href="search.php?type=t5">个人家教</a></li>
          <li><a href="search.php?type=t6">促销员</a></li>
          <li><a href="search.php?type=t7">发传单</a></li>
          <li><a href="search.php?type=t8">其他</a></li>
        </ul>
       </div>

       <!-- 右侧兼职工作展示 -->
       <div id="index_con" style="background-color: white" class="max_height">
           <div id="person_info_head">
              <div class="left_img"><img src="Images/you.jpg" width="200px" height="200px"></div>
              <div class="right_info">
                <div class="private_infors">
                  <p class="private_infors_bussname">小丸子</p>
                  
                  <p class="pub_position">共发布<span class="num_of_pro">3</span>件商品</p>
                </div>
                
              </div>
           </div>
           <div class="for_choice">
           <div id="person_con">
             <ul>
               <li>商家资料</li>
               <li>已发布工作</li>
               <li>申请记录</li>
         
             </ul>
           </div>
          <div id="B_choice_card">
                   <div class="bussiness_private">
                          <p class="b_name">公司名称：</p>
                           <div class="buss_name"> <?php echo $buss_nickname; ?></div>
                           <p class="b_mail">邮箱：</p>
                           <div class="buss_num"><?php echo $email['0']['buss_email']; ?>SB</div>
                           
                           <input type="button" value="确认修改" class="ensured_change"></input>
                   </div>
                   <div class="bussiness_saved">
                          <?php 
                          for($i = 0; $i < $result->num_rows; $i++){
                          ?> 
                           <div class="bussiness_content">
                           
                                 <div class="bussiness_pic">
                                 <img src="<?php echo $work[$i]['wkct_pic']; ?>" width="200px" height="180px">
                                 </div>
                                 <div class="bussiness_mian">
                                    <p class="buss_workname"><a href="#"> <?php echo $work[$i]['wkct_title']; ?></a></p>
                                    <span class="buss_make_time"><?php echo $work[$i]['wkct_createtime']; ?></span>
                                    <p class="bussiness_body"><?php echo $work[$i]['wkct_context']; ?></p>
                                    <?php 
                                    if(!$work[$i]['wkct_off']){ 
                                    ?>
                                      <p class="save_off">未下架</p>
                                    <?php 
                                    }
                                    else{
                                    ?>
                                      <p class="save_off">下架</p>
                                    <?php
                                    }
                                    ?>
                                 </div>
                            
                           </div>
                            <?php
                            }
                            ?> 
                   </div>
             
              <div id="buss_do" class="tab_show"> 
                       <table id="handle_work">
                         <thead>
                           <td class="work_title" style="width: 200px;">工作标题</td>
                           <td class="workstu_name" style="width:200px;">参加工作学生姓名</td>
                           <td class="do" style="width: 300px;">操作</td>
                         </thead>
                         <tbody id="handle_work_con">
                           <!-- <tr >
                             <td class="work_title">23</td>
                             <td class="workstu_name">32</td>
                             <td class="do"><a class="gray">已拒绝</a></td>
                         </tr> -->
                         </tbody>

                       </table>   
              </div>
             
          </div>
          </div>
       </div>
    </div>  


    <div class="mask"></div>
    <div  id="register_mask"></div> 
    <div id="agree_mask"> 
      <div id="agree_con" >
        <div class="form-group">
          <label for="interview_time">面试时间</label>
          <input type="text" class="form-control" id="interview_time">
        </div>
        <div class="form-group">
          <label for="interview_place">面试地点</label>
          <input type="text" class="form-control" id="interview_place">
        </div>
        <button id="close">close</button>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="Js/jquery.js"></script>
    <script src="Js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="Js/bootstrap.min.js"></script>
 
    <!--  窗口滚动导航缩放-->
    <script type="text/javascript" src="Js/scroll.js"></script>
    <script type="text/javascript" src="Js/business_info.js"></script>
    
   

    <script type="text/javascript">
      
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
    </script>

   <script type="text/javascript">
    $(function(){
      var wkId=[];
      var stuId=[];
      var wkStatus=[];
      $.ajax({
        url:'../server/buscheckstu.php',
        type:"POST",
        success:function(data){
          var obj=eval("("+data+")");
           for(var i=0;i<obj.data.length;i++)
           {
              $("#handle_work_con").append('<tr><td class="work_title"></td><td class="workstu_name"></td><td class="do"></td></tr>');
              $('#handle_work_con .work_title').eq(i).html(obj.data[i].wkct_title)
              $('#handle_work_con .workstu_name').eq(i).html(obj.data[i].wkct_people_name);
              wkId[i]=obj.data[i].wkct_id;
              stuId[i]=obj.data[i].stu_id;
              wkStatus[i]=obj.data[i].wk_status;
              
           }
           for(var i=0;i<obj.data.length;i++)
           {
               (function(arg){
                    if(wkStatus[i]==0)
                    { 
                        $('#handle_work_con .do').eq(i).append('<a id="bus_endwork" style="cursor:pointer;">工作结束</a>');
                        //var wkId=obj.data[i].wkct_id;
                        //var stuId=obj.data[i].stu_id;   
                        $('#handle_work_con .do').eq(i).children("a#bus_endwork").click(function(){
                         
                              $.ajax({
                                url:'../server/interview.php',
                                type:'POST',
                                data:{
                                  'func':'endworkbuss',
                                  'wkct_id':wkId[arg],
                                  'stu_id':stuId[arg]
                                },
                                success:function(data){
                                    var obj=eval("("+data+")");
                                    alert(obj.code+obj.data)
                                }
                              })
                             window.location='business_info.php';
                            
                          
                          })
                    }
                    if(wkStatus[i]==1)
                    {
                        $('#handle_work_con .do').eq(i).append('<a id="refuse" style="cursor:pointer;">拒绝面试</a>&nbsp;&nbsp;<a id="agree" style="cursor:pointer;">同意面试</a>');
                         //var wkId=obj.data[i].wkct_id;
                         //var stuId=obj.data[i].stu_id;   
                         $('#handle_work_con .do').eq(i).children('a#refuse').click(function(){
                              $.ajax({
                                url:'../server/interview.php',
                                type:'POST',
                                data:{
                                  'func':'refuseinterview',
                                  'wkct_id':wkId[arg],
                                  'stu_id':stuId[arg]
                                },
                                success:function(data){
                                    var obj=eval("("+data+")");
                                    alert(obj.code+obj.data)
                                }
                              })
                               window.location='business_info.php';
                          })

                         $('#handle_work_con .do').eq(i).children('a#agree').click(function(){
                              $('#agree_mask').css('display','block');
                              $('#close').click(function(){
                                $('#agree_mask').css('display','none');

                                  var time=$('#interview_time').val();
                                  var place=$('#interview_place').val();
                                  var data=time+place;
                                     $.ajax({
                                      url:'../server/interview.php',
                                      type:'POST',
                                      data:{
                                        'func':'agreeinterview',
                                        'wkct_id':wkId[arg],
                                        'stu_id':stuId[arg],
                                        'interview_data':data
                                      },
                                      success:function(data){
                                          var obj=eval("("+data+")");
                                          alert(obj.code+obj.data)
                                      }
                                    })
                                   // window.location='business_info.php';
                              })   
                          })
                    }
                     if(wkStatus[i]==2)
                    {
                        $('#handle_work_con .do').eq(i).append('<a class="gray">已拒绝</a>')
                    }
                    if(wkStatus[i]==3)
                    {
                        $('#handle_work_con .do').eq(i).append('<a id="adoptinterview" style="cursor:pointer;">面试通过</a>&nbsp;&nbsp;<a id="notadoptinterview" style="cursor:pointer;">不通过</a>');
                        //var wkId=obj.data[i].wkct_id;
                        // var stuId=obj.data[i].stu_id;   
                         $('#handle_work_con .do').eq(i).children('a#adoptinterview').click(function(){
                              $.ajax({
                                url:'../server/interview.php',
                                type:'POST',
                                data:{
                                  'func':'adoptinterview',
                                  'wkct_id':wkId[arg],
                                  'stu_id':stuId[arg]
                                },
                                success:function(data){
                                    var obj=eval("("+data+")");
                                    alert(obj.code+obj.data)
                                }
                              })
                              window.location='business_info.php';
                          })

                         $('#handle_work_con .do').eq(i).children('a#notadoptinterview').click(function(){
                              $.ajax({
                                url:'../server/interview.php',
                                type:'POST',
                                data:{
                                  'func':'notadoptinterview',
                                  'wkct_id':wkId[arg],
                                  'stu_id':stuId[arg]
                                },
                                success:function(data){
                                    var obj=eval("("+data+")");
                                   alert(obj.code+obj.data)
                                }
                              })
                              window.location='business_info.php';
                          })
                    }
                    if(wkStatus[i]==4)
                    {
                        $('#handle_work_con .do').eq(i).append('<a class="gray">面试未通过</a>')
                    }
                    if(wkStatus[i]==5)
                    {
                        $('#handle_work_con .do').eq(i).append('<a class="gray" >商家结束工作</a>')

                    }
                    if(wkStatus[i]==6)
                    {
                        $('#handle_work_con .do').eq(i).append('<a class="gray">学生结束工作</a>')
                    }
               })(i);
           }
        }

      })
    })
  </script>



     
  </body>
   <script type="text/javascript" src="Js/mess.js"></script>
</html>


