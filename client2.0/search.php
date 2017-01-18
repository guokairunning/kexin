<!DOCTYPE html>
<?php 
  header("Content-Type: text/html;charset=utf-8");
  ?>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>可辛工作</title>

    <link href="Css/index.css" rel="stylesheet">
    <link href="Css/job.css" rel="stylesheet">
    <link href="Css/search.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="Css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style=" background-color: #E3EEEC">
    <header class="ease" id="head">
		<!-- <a href="/">
		   <img class="logo ease" alt="" src="http://ershou.u.qiniudn.com/2shoujie_web_logo.png">
		</a> -->
		<div class="header-main center ease">
			<a class="slogan" href="index.php">
			   <h1 class="s-main"></h1>
			   <div class="s-submain"></div>
			   <img alt="西安邮电大学最安全方便的校园兼职市场" src="Images/0.png">
		    </a>
			<div class="search-box-wr ease">
				<form class="search-box center" method="get" action="../server/work_index.php">
					 <input class="search-submit" type="button" value="搜索" 
           id="keyword_search">
					<div class="input-wr">
					<span class="search-icon glyphicon glyphicon-search"></span>
					   <!-- <img class="search-icon" src="" > -->
						<div class="search-input">
						   <input id="keyword" type="text" placeholder="搜索你想做的校园兼职" x-webkit-speech="" name="keyword">  
						</div>

					</div>

				</form>
		
			</div>
      <div id="keyword_get" style="display:none;"><?php  echo $_GET['keyword']; ?></div>
			<!--<div class="log-reg ease">
			   <div class="button" data-type="l">登录</div>
			   <div class="button" data-type="r">注册</div>
			</div>-->
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
    <div id="search_box">
        <ul id="search_title">
            <li id="default">默认</li>
            <li id="time">时间</li>
            <li id="hots">热度</li>
        </ul>
        <ul id="search_box_con">
            
        </ul>
    </div>
    <div class="footer" style="background:url('Images/footer-bg.png');">
      
    </div>
    <div class="mask"></div>
    <div  id="register_mask"></div> 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="Js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="Js/bootstrap.min.js"></script>

     <!--  窗口滚动导航缩放-->
    <script type="text/javascript" src="Js/scroll.js"></script>

    <!-- 登录注册页面的显示隐藏  -->
  <script type="text/javascript" src="Js/request_logoin_register.js"></script>

   <script type="text/javascript">
   // 按类型搜索
      $(function(){
         var url_str=window.location.href;
         var keyword=url_str.slice(url_str.indexOf('=')+1);
         switch(keyword)
         {
             case 't1':keyword='打扫卫生';break;
             case 't2':keyword='图书馆助理';break;
             case 't3':keyword='餐厅助理';break;
             case 't4':keyword='校园代理';break;
             case 't5':keyword='个人家教';break;
             case 't6':keyword='促销员';break;
             case 't7':keyword='发传单';break;
             case 't8':keyword='其他';break;
        
         }
         if(keyword=='打扫卫生'||keyword=='图书馆助理'||keyword=='餐厅助理'||keyword=='校园代理'||keyword=='个人家教'||keyword=='促销员'||keyword=='发传单'||keyword=='其他')
         {
              $.ajax({ 
                url:'../server/work_index.php',
                type:'GET',
                contentType:'application/x-www-form-urlencoded;charset=utf-8',
                data:{
                    'func':'type',
                    'wk_type':keyword
                },
              success:function(data){ 
              var obj=eval("("+data+")");
               $("ul#search_box_con").children().remove();
              for(var i=0;i<obj.data.length;i++)
              {
                $("ul#search_box_con").append('<li><a href=""><img class="job_pic"/></a><div class="job_info"><p class="job_title"></p><div class="people_wages"><p>发布人:<span class="job_people"></span> 工资:<span class="job_wages"></span></p></div></div></li>');
               
                     $('.job_pic').eq(i).attr("src",obj.data[i].wkct_pic);
                     $('.job_title').eq(i).html(obj.data[i].wkct_title);
                     $('.job_people').eq(i).html(obj.data[i].wkct_peopel_name);
                     $('.job_wages').eq(i).html(obj.data[i].wkct_wages);
                     $("ul#search_box_con li a").eq(i).attr("href","../server/job.php?id="+obj.data[i].wkct_id);
                     $('people_wages').css({
                      "width":"205px",
                      "height":"30px",
                      "background-color":"red",

                     })
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
         }
         
      })
    </script>
    <script type="text/javascript">
   // 首页按名称搜索到该页面
      $(function(){
         //var url_str=window.location.href;
        //url_str.slice(url_str.indexOf('=')+1);
         var keyword=$('#keyword_get').text();
      // alert(keyword)
         if(keyword!='t1'&&keyword!='t2'&&keyword!='t3'&&keyword!='t4'&&keyword!='t5'&&keyword!='t6'&&keyword!='t7'&&keyword!='t8')
          {  
             $.ajax({ 
              url:'../server/work_index.php',
              type:'GET',
              contentType:'application/x-www-form-urlencoded;charset=utf-8',
              data:{
                  'func':'name',
                  'wk_name':keyword
              },
            success:function(data){ 
            var obj=eval("("+data+")");
             $("ul#search_box_con").children().remove();
            for(var i=0;i<obj.data.length;i++)
            {
              $("ul#search_box_con").append('<li><a href=""><img class="job_pic"/></a><div class="job_info"><p class="job_title"></p><div class="people_wages"><p>发布人:<span class="job_people"></span> 工资:<span class="job_wages"></span></p></div></div></li>');
             
                   $('.job_pic').eq(i).attr("src",obj.data[i].wkct_pic);
                   $('.job_title').eq(i).html(obj.data[i].wkct_title);
                   $('.job_people').eq(i).html(obj.data[i].wkct_peopel_name);
                   $('.job_wages').eq(i).html(obj.data[i].wkct_wages);
                   $("ul#search_box_con li a").eq(i).attr("href","../server/job.php?id="+obj.data[i].wkct_id);
                   $('people_wages').css({
                    "width":"205px",
                    "height":"30px",
                    "background-color":"red",

                   })
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

         }
       
      })
    </script>

<script type="text/javascript">
// 按名字搜索
      $(function(){
        $('#keyword_search').click(function(){
          var keyword=$('#keyword').val();
            $.ajax({
              url:'../server/work_index.php',
              type:'GET',
              contentType:'application/x-www-form-urlencoded;charset=utf-8',
              data:{
                  'func':'name',
                  'wk_name':keyword
              },
              success:function(data){ 
                    var obj=eval("("+data+")");
                    $("ul#search_box_con").children().remove();
                    for(var i=0;i<obj.data.length;i++)
                    {
                      $("ul#search_box_con").append('<li><a href=""><img class="job_pic"/></a><div class="job_info"><p class="job_title"></p><div class="people_wages"><p>发布人:<span class="job_people"></span> 工资:<span class="job_wages"></span></p></div></div></li>');
                     
                       $('.job_pic').eq(i).attr("src",obj.data[i].wkct_pic);
                       $('.job_title').eq(i).html(obj.data[i].wkct_title);
                       $('.job_people').eq(i).html(obj.data[i].wkct_peopel_name);
                       $('.job_wages').eq(i).html(obj.data[i].wkct_wages);
                       $("ul#search_box_con li a").eq(i).attr("href","../server/job.php?id="+obj.data[i].wkct_id);
                        $('.job_title').eq(i).css({
                           "font-size":"20px" ,
                           "color":"#1B816C"
                       })
                         $('.job_people').eq(i).css({
                           "font-size":"14px" ,
                           "color":"#949BBB"
                       })

                    }           
              }
            })
        })
        
      })
</script>
<script type="text/javascript">
//默认排序
  $(function(){
     $('#default').click(function(){
        var url_str=window.location.href;
        var keyword_con=url_str.substr(url_str.indexOf('?')+1,4);
         // 默认排序中url中传过来是keyword  不是类型
        
        if($('#keyword').val().length==0&&keyword_con=='keyw')
         {
             var url_str=window.location.href;
             var keyword=url_str.slice(url_str.indexOf('=')+1);
             if(keyword!='t1'&&keyword!='t2'&&keyword!='t3'&&keyword!='t4'&&keyword!='t5'&&keyword!='t6'&&keyword!='t7'&&keyword!='t8')
             {  
                 $.ajax({ 
                  url:'../server/work_index.php',
                  type:'GET',
                  contentType:'application/x-www-form-urlencoded;charset=utf-8',
                  data:{
                      'func':'name',
                      'wk_name':keyword
                  },
                success:function(data){ 
                var obj=eval("("+data+")");
                 $("ul#search_box_con").children().remove();
                for(var i=0;i<obj.data.length;i++)
                {
                  $("ul#search_box_con").append('<li><a href=""><img class="job_pic"/></a><div class="job_info"><p class="job_title"></p><div class="people_wages"><p>发布人:<span class="job_people"></span> 工资:<span class="job_wages"></span></p></div></div></li>');
                 
                       $('.job_pic').eq(i).attr("src",obj.data[i].wkct_pic);
                       $('.job_title').eq(i).html(obj.data[i].wkct_title);
                       $('.job_people').eq(i).html(obj.data[i].wkct_peopel_name);
                       $('.job_wages').eq(i).html(obj.data[i].wkct_wages);
                       $("ul#search_box_con li a").eq(i).attr("href","../server/job.php?id="+obj.data[i].wkct_id);
                       $('people_wages').css({
                        "width":"205px",
                        "height":"30px",
                        "background-color":"red",

                       })
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

             }
       
         }



        if($('#keyword').val().length==0&&keyword_con=='type')
        {
         var url_str=window.location.href;
         var keyword=url_str.slice(url_str.indexOf('=')+1);
         switch(keyword)
         {
             case 't1':keyword='打扫卫生';break;
             case 't2':keyword='图书馆助理';break;
             case 't3':keyword='餐厅助理';break;
             case 't4':keyword='校园代理';break;
             case 't5':keyword='个人家教';break;
             case 't6':keyword='促销员';break;
             case 't7':keyword='发传单';break;
             case 't8':keyword='其他';break;
        
         }
        $.ajax({ 
              url:'../server/work_index.php',
              type:'GET',
              contentType:'application/x-www-form-urlencoded;charset=utf-8',
              data:{
                  'func':'type',
                  'wk_type':keyword
              },
            success:function(data){ 
            var obj=eval("("+data+")");
             $("ul#search_box_con").children().remove();
            for(var i=0;i<obj.data.length;i++)
            {
              $("ul#search_box_con").append('<li><a href=""><img class="job_pic"/></a><div class="job_info"><p class="job_title"></p><div class="people_wages"><p>发布人:<span class="job_people"></span> 工资:<span class="job_wages"></span></p></div></div></li>');
             
                   $('.job_pic').eq(i).attr("src",obj.data[i].wkct_pic);
                   $('.job_title').eq(i).html(obj.data[i].wkct_title);
                   $('.job_people').eq(i).html(obj.data[i].wkct_peopel_name);
                   $('.job_wages').eq(i).html(obj.data[i].wkct_wages);
                   $("ul#search_box_con li a").eq(i).attr("href","../server/job.php?id="+obj.data[i].wkct_id);
                   $('people_wages').css({
                    "width":"205px",
                    "height":"30px",
                    "background-color":"red",

                   })
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
        }

        if($('#keyword').val().length!=0)
        {
            var keyword=$('#keyword').val();
            $.ajax({
              url:'../server/work_index.php',
              type:'GET',
              contentType:'application/x-www-form-urlencoded;charset=utf-8',
              data:{
                  'func':'name',
                  'wk_name':keyword
              },
              success:function(data){ 
                    var obj=eval("("+data+")");
                    $("ul#search_box_con").children().remove();
                    for(var i=0;i<obj.data.length;i++)
                    {
                      $("ul#search_box_con").append('<li><a href=""><img class="job_pic"/></a><div class="job_info"><p class="job_title"></p><div class="people_wages"><p>发布人:<span class="job_people"></span> 工资:<span class="job_wages"></span></p></div></div></li>');
                     
                       $('.job_pic').eq(i).attr("src",obj.data[i].wkct_pic);
                       $('.job_title').eq(i).html(obj.data[i].wkct_title);
                       $('.job_people').eq(i).html(obj.data[i].wkct_peopel_name);
                       $('.job_wages').eq(i).html(obj.data[i].wkct_wages);
                       $("ul#search_box_con li a").eq(i).attr("href","../server/job.php?id="+obj.data[i].wkct_id);
                        $('.job_title').eq(i).css({
                           "font-size":"20px" ,
                           "color":"#1B816C"
                       })
                         $('.job_people').eq(i).css({
                           "font-size":"14px" ,
                           "color":"#949BBB"
                       })

                    }           
              }
            })
        }

         
     })
  })

</script>
<script type="text/javascript">
//热度排序和时间排序
  function sort(sort_type){
    var keyword=$('#keyword').val();
            $.ajax({
              url:'../server/work_index.php',
              type:'GET',
              contentType:'application/x-www-form-urlencoded;charset=utf-8',
              data:{
                  'func':'name',
                  'sort':sort_type,
                  'wk_name':keyword
                  
              },
              success:function(data){ 
                    var obj=eval("("+data+")");
                    $("ul#search_box_con").children().remove();
                    for(var i=0;i<obj.data.length;i++)
                    {
                      $("ul#search_box_con").append('<li><a href=""><img class="job_pic"/></a><div class="job_info"><p class="job_title"></p><div class="people_wages"><p>发布人:<span class="job_people"></span> 工资:<span class="job_wages"></span></p></div></div></li>');
                     
                       $('.job_pic').eq(i).attr("src",obj.data[i].wkct_pic);
                       $('.job_title').eq(i).html(obj.data[i].wkct_title);
                       $('.job_people').eq(i).html(obj.data[i].wkct_peopel_name);
                       $('.job_wages').eq(i).html(obj.data[i].wkct_wages);
                       $("ul#search_box_con li a").eq(i).attr("href","../server/job.php?id="+obj.data[i].wkct_id);
                        $('.job_title').eq(i).css({
                           "font-size":"20px" ,
                           "color":"#1B816C"
                       })
                         $('.job_people').eq(i).css({
                           "font-size":"14px" ,
                           "color":"#949BBB"
                       })

                    }            
              }
            })
  }

  function sort_1(sort_type){
      var url_str=window.location.href;
      var keyword=url_str.slice(url_str.indexOf('=')+1);
         // keyword=parseInt(keyword);
         switch(keyword)
         {
             case 't1':keyword='打扫卫生';break;
             case 't2':keyword='图书馆助理';break;
             case 't3':keyword='餐厅助理';break;
             case 't4':keyword='校园代理';break;
             case 't5':keyword='个人家教';break;
             case 't6':keyword='促销员';break;
             case 't7':keyword='发传单';break;
             case 't8':keyword='其他';break;
        
         }
        $.ajax({ 
              url:'../server/work_index.php',
              type:'GET',
              contentType:'application/x-www-form-urlencoded;charset=utf-8',
              data:{
                  'func':'type',
                  'sort':sort_type,
                  'wk_type':keyword
              },
            success:function(data){ 
            var obj=eval("("+data+")");
             $("ul#search_box_con").children().remove();
            for(var i=0;i<obj.data.length;i++)
            {
              $("ul#search_box_con").append('<li><a href=""><img class="job_pic"/></a><div class="job_info"><p class="job_title"></p><div class="people_wages"><p>发布人:<span class="job_people"></span> 工资:<span class="job_wages"></span></p></div></div></li>');
             
                   $('.job_pic').eq(i).attr("src",obj.data[i].wkct_pic);
                   $('.job_title').eq(i).html(obj.data[i].wkct_title);
                   $('.job_people').eq(i).html(obj.data[i].wkct_peopel_name);
                   $('.job_wages').eq(i).html(obj.data[i].wkct_wages);
                   $("ul#search_box_con li a").eq(i).attr("href","../server/job.php?id="+obj.data[i].wkct_id);
                   $('people_wages').css({
                    "width":"205px",
                    "height":"30px",
                    "background-color":"red",

                   })
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
  }

  function sort_2(sort_type)
  {
         var url_str=window.location.href;
         var keyword=url_str.slice(url_str.indexOf('=')+1);
         if(keyword!='t1'&&keyword!='t2'&&keyword!='t3'&&keyword!='t4'&&keyword!='t5'&&keyword!='t6'&&keyword!='t7'&&keyword!='t8')
         {  
             $.ajax({ 
              url:'../server/work_index.php',
              type:'GET',
              contentType:'application/x-www-form-urlencoded;charset=utf-8',
              data:{
                  'func':'name',
                  'wk_name':keyword,
                  'sort':sort_type,
              },
            success:function(data){ 
            var obj=eval("("+data+")");
             $("ul#search_box_con").children().remove();
            for(var i=0;i<obj.data.length;i++)
            {
              $("ul#search_box_con").append('<li><a href=""><img class="job_pic"/></a><div class="job_info"><p class="job_title"></p><div class="people_wages"><p>发布人:<span class="job_people"></span> 工资:<span class="job_wages"></span></p></div></div></li>');
             
                   $('.job_pic').eq(i).attr("src",obj.data[i].wkct_pic);
                   $('.job_title').eq(i).html(obj.data[i].wkct_title);
                   $('.job_people').eq(i).html(obj.data[i].wkct_peopel_name);
                   $('.job_wages').eq(i).html(obj.data[i].wkct_wages);
                   $("ul#search_box_con li a").eq(i).attr("href","../server/job.php?id="+obj.data[i].wkct_id);
                   $('people_wages').css({
                    "width":"205px",
                    "height":"30px",
                    "background-color":"red",

                   })
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

         }
  }
  $(function(){

            var url_str=window.location.href;
            var keyword_con=url_str.substr(url_str.indexOf('?')+1,4);
   
          $('#hots').click(function(){ 

            if($('#keyword').val().length==0&&keyword_con=='keyw')
            {
              
              sort_2('hot');
            }

            if($('#keyword').val().length==0&&keyword_con=='type')
            { 
              
               sort_1('hot');
            }
            if($('#keyword').val().length!=0)
            {
              sort('hot');
            }

           
        
            
        })

        $('#time').click(function(){
           if($('#keyword').val().length==0&&keyword_con=='keyw')
            {
              sort_2('time');
            }

            if($('#keyword').val().length==0&&keyword_con=='type')
            {
              sort_1('time');
            }
            if($('#keyword').val().length!=0)
            {
               sort('time');
            }

           
       })   
  })  
</script>
 <script type="text/javascript" src="Js/mess.js"></script>

  </body>
</html>