 <!DOCTYPE html>
 <?php 
  header("Content-Type: text/html;charset=utf-8");?>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>可辛</title>

    <link href="Css/index.css" rel="stylesheet">
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
					<input class="search-submit" type="submit" value="搜索" id="keyword_search">
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
        session_start();
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
       <div id="index_con">
            <div class="title">
              <p>推荐工作</p>

            </div>
            <div id="need">
              <p class="block" style="cursor: pointer;" id="inschool">校内</p>
             
              <p class="block"style="cursor: pointer;" id="outschool">校外</p>
            </div>
            <ul id="job_con_box"> 
                <!--  <li>
                    <img src="" id="job_pic"/>
                    <div class="job_info">
                    <p id="job_title"></p>
                    <p>发布人:<span id='job_people'></span> 工资:<span id="job_wages"></span></p>
                    </div>
                 </li> -->
            </ul>
       </div>
       <div style="position:absolute;left:1170px;top:160px;">
         <?php 
            if(isset($_SESSION['user_id'])){
            if($_SESSION['user_type'] == 2){
              echo "<p style='width:150px;height:50px;background:#FFB200;text-align: center;line-height: 50px;'><a href='release.php'>发布工作</a></p>";
            }}
            ?>
       </div>

        <div id="footer" style="background:url('Images/footer-bg.png');">
      
        </div>
    </div>  

   
    <div class="mask"></div>
    <div  id="register_mask" ></div> 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="Js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="Js/bootstrap.min.js"></script>
 
    <!--  窗口滚动导航缩放-->
    <script type="text/javascript" src="Js/scroll.js"></script>
<!-- 登录注册页面的显示隐藏  -->
  <script type="text/javascript" src="Js/request_logoin_register.js"></script>
    <script type="text/javascript">
      $(function(){
        // ajax请求全部工作
        $.ajax({ 
            url: '../server/work_index.php?t='+Math.random(),
            type: 'GET',
            contentType:'application/x-www-form-urlencoded;charset=utf-8',
            data:{
              'func':'index',
              'inschool':'1'
            },
            success:function(data){ 
            var obj=eval("("+data+")");
            
            for(var i=0;i<obj.data.length;i++)
            {
              $("ul#job_con_box").append('<li><a href=""><img class="job_pic"/></a><div class="job_info"><p class="job_title"></p><p>发布人:<span class="job_people"></span> 工资:<span class="job_wages"></span></p></div></li>');
               $('.job_pic').eq(i).attr("src",obj.data[i].wkct_pic);
               $('.job_title').eq(i).html(obj.data[i].wkct_title);
               $('.job_people').eq(i).html(obj.data[i].wkct_peopel_name);
               $('.job_wages').eq(i).html(obj.data[i].wkct_wages);
               $("ul#job_con_box li a").eq(i).attr("href","../server/job.php?id="+obj.data[i].wkct_id);
                $('.job_title').eq(i).css({
                   "font-size":"20px" ,
                   "color":"#1B816C"
               })
                 $('.job_people').eq(i).css({
                   "font-size":"14px" ,
                   "color":"#949BBB"
               })
            }   
            },
            error:function(){
              alert('访问出错！');
            }
          });
      })
    </script>
<script type="text/javascript">
      $(function(){
         // ajax请求校外工作
        $('#outschool').click(function(){
           $.ajax({ 
            url: '../server/work_index.php?t='+Math.random(),
            type: 'GET',
             contentType:'application/x-www-form-urlencoded;charset=utf-8',
            data:{
              'func':'index',
              'inschool':'0'
            },
            success:function(data){ 
            var obj=eval("("+data+")");
            $("ul#job_con_box").children().remove();
            for(var i=0;i<obj.data.length;i++)
            {
              $("ul#job_con_box").append('<li><a href=""><img class="job_pic"/></a><div class="job_info"><p class="job_title"></p><p>发布人:<span class="job_people"></span> 工资:<span class="job_wages"></span></p></div></li>');
             
               $('.job_pic').eq(i).attr("src",obj.data[i].wkct_pic);
               $('.job_title').eq(i).html(obj.data[i].wkct_title);
               $('.job_people').eq(i).html(obj.data[i].wkct_peopel_name);
               $('.job_wages').eq(i).html(obj.data[i].wkct_wages);
                $("ul#job_con_box li a").eq(i).attr("href","../server/job.php?id="+obj.data[i].wkct_id);
                $('.job_title').eq(i).css({
                   "font-size":"20px" ,
                   "color":"#1B816C"
               })
                 $('.job_people').eq(i).css({
                   "font-size":"14px" ,
                   "color":"#949BBB"
               })

            }       
            },
            error:function(){
              alert('访问出错！');
            }
          });
        })
     // ajax请求校内工作
         $('#inschool').click(function(){
           $.ajax({ 
            url: '../server/work_index.php?t='+Math.random(),
            type: 'GET',
             contentType:'application/x-www-form-urlencoded;charset=utf-8',
            data:{
              'func':'index',
              'inschool':'1'
            },
            success:function(data){ 
            var obj=eval("("+data+")");
            $("ul#job_con_box").children().remove();
            for(var i=0;i<obj.data.length;i++)
            {
              $("ul#job_con_box").append('<li><a href=""><img class="job_pic"/></a><div class="job_info"><p class="job_title"></p><p>发布人:<span class="job_people"></span> 工资:<span class="job_wages"></span></p></div></li>');
               $('.job_pic').eq(i).attr("src",obj.data[i].wkct_pic);
               $('.job_title').eq(i).html(obj.data[i].wkct_title);
               $('.job_people').eq(i).html(obj.data[i].wkct_peopel_name);
               $('.job_wages').eq(i).html(obj.data[i].wkct_wages);
                $("ul#job_con_box li a").eq(i).attr("href","../server/job.php?id="+obj.data[i].wkct_id);
                $('.job_title').eq(i).css({
                   "font-size":"20px" ,
                   "color":"#1B816C"
               })
                 $('.job_people').eq(i).css({
                   "font-size":"14px" ,
                   "color":"#949BBB"
               })
            }   
            },
            error:function(){
              alert('访问出错！');
            }
          });
        })
   
      })
</script>
 <script type="text/javascript" src="Js/mess.js"></script>
   
</body>
</html>

