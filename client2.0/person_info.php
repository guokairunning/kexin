 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <?php     //收藏展示
  include_once "../server/api/function.php";
  session_start();
  $stu_id = $_SESSION['user_id'];
  $stu_nickname = $_SESSION['user_name'];

  if(!empty($stu_id)){
    $conn = mysqliConnect();//连接数据库
    $query = "set names utf8";
    $result = $conn->query($query);
    $query = "SELECT wkct_id,wkct_title,wkct_context,wkct_off FROM work_collection WHERE stu_id='".$stu_id."'";
    $result = $conn->query($query);
    if($result){
      for($i = 0; $i < $result->num_rows; $i++){   
        $return[] = $result->fetch_assoc();
      }
    }
    $query = "SELECT * FROM message WHERE mess_belong_id='".$stu_id."' AND mess_haveread=0";
    $result_1 = $conn->query($query);
    if($result_1 && $result_1->num_rows){
      for($i = 0; $i < $result_1->num_rows; $i++){
        $message[] = $result_1->fetch_assoc();
      }
      $query = "UPDATE message SET mess_haveread=1 WHERE mess_belong_id='".$stu_id."' AND mess_haveread=0";
      $result_2 = $conn->query($query);
    }
    $query = "SELECT wkct_id,wkct_people_name,wk_status,wkct_title FROM working WHERE stu_id='".$stu_id."'";
    $result_3 = $conn->query($query);
    if($result_3){
      for($i = 0; $i < $result_3->num_rows; $i++){
        $stu_work[] = $result_3->fetch_assoc();
      }
    }
     

        
  }
  else{
    //header("location: ----");
  }
  $sql="SELECT stu_num,stu_name,stu_school,stu_exp,stu_label,stu_head FROM student_info WHERE stu_id=$stu_id";
              var_dump($sql);
              $result_4=$conn->query($sql);
              //var_dump($result);
              @$re_num=$result_4->num_rows;
              
              $name = '';
              $num = '';
              $school = '';
              $label = '';
              $exp = '';
              $head = '';
              if($re_num){
                   $row=$result_4->fetch_object();
                   $name=$row->stu_name;   
                   $num=$row->stu_num;
                   $school=$row->stu_school;
                   $label=$row->stu_label;
                   $exp=$row->stu_exp;
                   $head=$row->stu_head;
              }
              $exp=json_decode($exp,1);
              $data = getRank($exp['exp1'],$exp['exp2'],$exp['exp3'],$exp['exp4'],$exp['exp5'],$exp['exp6']);
              $data = json_decode($data,1);
?>
 <!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>可辛个人中心</title>

    <link href="../client2.0/Css/index.css" rel="stylesheet">
    <link href="../client2.0/Css/person_info.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="../client2.0/Css/bootstrap.min.css" rel="stylesheet">

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
       <img class="logo ease" alt="" src="../client2.0/Images/1.png">
    </a>
    <div class="header-main center ease">
      <a class="slogan" href="index.php">
         <h1 class="s-main"></h1>
         <div class="s-submain"></div>
         <img alt="西安邮电大学最安全方便的校园兼职市场" src="Images/0.png">
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
       <div id="navbar" class="ease">
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
              <div class="left_img"><img src="<?php echo $head; ?>" width="200px" height="200px"></div>
              <div class="right_info">
                <div class="private_infors">
                  <span class="private_infors_name">小丸子</span>
                  <img class="pic_lev" src="../client2.0/Images/ico_lv2.png" width="67px" height="40px" style="margin-top:0 ">
                  <p class="sell_position">已卖出3件商品</p>
                </div>
                <div class="bank">
                  <table>
                    <tr>
                      <td class="now_bank">当前等级：</td>
                      <td class="now_bank_value"><?php echo $data['rank']; ?></td>
                      
                    </tr>
                    <tr>
                      <td class="now_grade">当前积分：</td>
                      <td class="now_grade_value"><?php echo $data['grade']; ?></td>
                      
                    </tr>
                    <tr>
                      <td class="risebank_need">升级还需：</td>
                      <td class="risebank_need_value"><?php echo $data['need']; ?></td>
                      
                    </tr>
                  </table>
                </div>
              </div>
           </div>
           <div class="for_choice">
           <div id="person_con">
             <ul>
               <li>个人资料</li>
               <li>我的收藏</li>
               <li>消息中心</li>
               <li>我的工作</li>
               <li>个人经验</li>
             </ul>
           </div>
          <div id="choice_card">
         
         
         
         


                   <div class="person_private">
           <form action="../server/stu_info.php" method="POST">
                          <p class="s_name">学生姓名：</p>
                           <input type="text" class="stu_name" name="name" value="<?php echo $name;?>"></input>
                           <p class="s_num">学号：</p>
                           <input type="text" class="stu_num" name="num" value="<?php echo $num;?>"></input>
                           <p class="s_school">所属学校：</p>
                           <input type="text" class="stu_school" name="school" value="<?php echo $school;?>"></input>
                           <p class="s_label">标签：</p>
                           <input type="test" class="stu_label" name="label" value="<?php echo $label;?>"></input>
                           <input type="submit" value="确认修改" class="ensure_change"></input>

            </form>
                   </div>


                   <div class="person_saved">
             <?php 
             for($i = 0; $i < $result->num_rows; $i++){
              $picture = getPicture($return[$i]['wkct_id']);
              ?>
                     <div class="save_content">
                           <div class="save_pic">
                                 <img src="<?php echo $picture;?>" width="200px" height="180px">
                                 </div>
                           <div class="save_mian">
                              <p class="save_name"> <?php echo $return[$i]['wkct_title']; ?></p>
                              <p class="save_body"><?php echo $return[$i]['wkct_context']; ?></p>
                              <?php 
                              if(!$return[$i]['wkct_off']){ 
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
                           <div class="save_button">
                               <a href="../server/delcollect.php?wkct_id=<?php echo $return[$i]['wkct_id']; ?>"><input type="button" value="取消收藏"></input></a>
                           </div>
                     </div>
             <?php
             }
             ?>
             </div>


             <div class="person_message">
            
                <p class="unread">最新消息</p>
                 <?php 
                  for($i = 0; $i < $result_1->num_rows; $i++){
                 ?>
                           <div class="message_mian">
                              <div class="maker">
                              <span>发信人：</span>
                              <span class="message_sender"> <?php echo $message[$i]['mess_send_nickname']; ?></span>
                              <span class="make_time"><?php echo $message[$i]['mess_createtime']; ?></span>
                              </div>
                              <p class="message_body"> <?php echo $message[$i]['mess_content']; ?></p>
                             
                              <input class="message_off" type="button" value="未读"></input>

                           </div>
                 <?php
                  }
                 ?>              
             </div>
             

             <div class="person_work">

              
                      <?php 
                      for($i = 0; $i < $result_3->num_rows; $i++){
                        $picture = getPicture($stu_work[$i]['wkct_id']);
                      ?> 
                      <div class="work_content">
                      <div class="work_pic">
                          <img src="<?php echo $picture;?>" width="200px" height="201px">
                      </div>

                      <div class="work_mian">
                                    <p class="work_name"> <?php echo $stu_work[$i]['wkct_title']; ?></p>
                                    <div class="boss"><p style="display:none; " class="endworkstu"><?php echo $stu_work[$i]['wkct_id'];?></p>
                                      <span>发布人：</span>
                                      <span class="work_boss"> <?php echo $stu_work[$i]['wkct_people_name']; ?></span>
                                      <?php $wk_status = workstatus($stu_work[$i]['wk_status'])?>
                                      <p class="save_off"> <?php echo $wk_status; ?></p>
                          <p style="position:relative;left:450px;top:50px;width:100px;
                          height:35px;text-align:center;cursor:pointer;background:#ccc" class="endwork_stu">结束工作</p>
                                    </div>  
                                     </div> 
                                     </div>                     
                      <?php
                      }
                      ?>
                       
             </div>
             <div class="person_experience">
               <div id="experience_value"></div>

             </div>
         
          </div>
       </div>
    </div>  


    <div class="mask"></div>
    <div  id="register_mask"></div> 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../client2.0/Js/jquery.js"></script>
    <script src="../client2.0/Js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../client2.0/Js/bootstrap.min.js"></script>
 
    <!--  窗口滚动导航缩放-->
    <script type="text/javascript" src="../client2.0/Js/scroll.js"></script>
    <script type="text/javascript" src="../client2.0/Js/person_info.js"></script>
    <script type="text/javascript" src="../client2.0/Js/echarts.min.js"></script>


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

  
    <?php
        
        // var_dump($exp);
        //echo "sql==".$exp['exp1'];
   ?>

    <script type="text/javascript">
               var myChart = echarts.init(document.getElementById('experience_value'));
                 var option = {
    title: {
        text: '个人经验分布图'
    },
    tooltip: {},
    legend: {
        data: ['能力分布（Ability Distribution）']
    },
    radar: {
        // shape: 'circle',
        indicator: [
           { name: '专业能力（Professional competence）', max: 100},
           { name: '学习能力（Learning ability）', max: 100},
           { name: '沟通与合作（Communication & cooperation）', max: 100},
           { name: '责任心（Posibility）', max: 100},
           { name: '抗压能力（Stress tolerance）', max: 100},
           { name: '集体荣誉感（Sense of group honor）', max: 100}
        ]
    },
    series: [{
        name: '能力（Ability）',
        type: 'radar',
        // areaStyle: {normal: {}},
        data : [
            {
                value : [<?php echo $exp['exp1'];?>,<?php echo $exp['exp2'];?>,<?php echo $exp['exp3'];?>,<?php echo $exp['exp4'];?>,<?php echo $exp['exp5'];?>,<?php echo $exp['exp6'];?>],
                name : '能力分布（Ability Distribution）'

  
            }
            
        ]
    }]
};
        myChart.setOption(option);
       
 
    </script>


<script type="text/javascript" src="Js/mess.js"></script>

   <script type="text/javascript">
   $(function(){
    var length=$('.endworkstu').length;
    var id=[]; 
    for(var i=0;i<length;i++)
    {
        id[i]=$('.endworkstu').eq(i).text();
    }
    for(var i=0;i<length;i++)
    {
        (function(arg){
          $('.endwork_stu').eq(i).click(function(){
              $.ajax({
              url:"../server/interview.php",
              type:"POST",
              data:{
                'func':'endworkstu',
                'wkct_id':id[arg],

               },
              success:function(data){
                var obj=eval("(+data+)");
                alert(obj.code)
              }


               })
            })
        })(i);
    }
   

   
   
   })
   </script>
  </body>
</html>