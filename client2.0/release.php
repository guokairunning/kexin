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
    <title>可辛发布</title>

    <link href="Css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="Css/release.css">
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
           <div id="release_con">
             <div class="head">
               <img src="Images/release-icon.png">
               <h2><strong>发布工作</strong></h2>
             </div>  
             <div>
                <form class="form-horizontal" method="post" action="../server/work_create.php" id="release_form" enctype="multipart/form-data">
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">工作标题</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="title" id="title">
                        </div>
                      </div>
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">工作分类</label>
                        <div class="col-sm-4">
                         <select class="form-control" name="type" id="type">
                            <option>其他</option>
                            <option>打扫卫生</option>
                            <option>图书馆助理</option>
                            <option>餐厅助理</option>
                            <option>校园代理</option>
                            <option>个人家教</option>
                            <option>促销员</option>
                            <option>发传单</option>
                         </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">详细信息</label>
                        <div class="col-sm-8">
                           <textarea class="form-control" rows="4" style="resize: none;" name="context"  id="context"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">工作地点</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="place" id="place">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">工作时间</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="wktime" id="wktime" >
                        </div>
                      </div>
                      <div class="form-group">
                         <label class="col-sm-2 control-label">是否在校</label>
                         <div class="col-sm-6">
                         <label class="radio-inline">
                          <input type="radio" name="inschool" value="1" checked="checked"> 校内
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="inschool" value="0"> 校外
                        </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">工资薪酬</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="wages" id="wages">
                        </div>
                      </div>
                      <div class="form-group">
                          <label for="InputFile" class="col-sm-2 control-label">图片上传</label>
                         <div class="col-sm-6">
                          <input type="file"  name="file1" id="file1"  />
                         </div>  
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">联系电话</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="phone" id="phone">
                        </div>
                      </div>
                       <div class="form-group form-inline">
                        <label class="col-sm-2 control-label">工作所需能力</label>
                        <div class="col-sm-8">
                            <div class="col-sm-4" >
                                专业能力
                             <select class="form-control input-sm" name="exp" id="exp1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                             </select>
                            </div>
                            <div class="col-sm-4">
                                学习能力
                             <select class="form-control input-sm" name="exp" id="exp2">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                             </select>
                            </div>
                           <div class="col-sm-4">
                               沟通与合作
                             <select class="form-control input-sm" name="exp" id="exp3">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                             </select>
                            </div>
                            <div class="col-sm-4"  style="margin-top: 20px;">
                               &nbsp;&nbsp;&nbsp;&nbsp;责任心
                             <select class="form-control input-sm" name="exp" id="exp4">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                             </select>
                            </div>
                             <div class="col-sm-4"  style="margin-top: 20px;">
                                抗压能力
                             <select class="form-control input-sm" name="exp" id="exp5">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                             </select>
                             </div>
                             <div class="col-sm-4" style="margin-top: 20px;">
                                集体荣誉感
                             <select class="form-control input-sm" name="exp" id="exp6">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                             </select>
                            </div>
                        </div>
                      </div>
                     
                      <div class="form-group form-inline">
                        <div class="col-sm-offset-2 col-sm-3">
                          <input type="button" class="btn btn-default" id="release_submit" value="马上发布">
                        </div>
                        <div class="col-sm-3">
                          <input type="reset" class="btn btn-default"  value="重新填写" id="reset">
                        </div>
                      </div>
                </form>
             </div> 

           </div>

        <div id="footer" style="background:url('Images/footer-bg.png');">
        </div>
    </div>  


    <div class="mask"></div>
    <div  id="register_mask" ></div> 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="Js/jquery.js"></script>
    <script src="Js/jquery.min.js"></script>
    <script type="text/javascript" src="Js/ajax.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="Js/bootstrap.min.js"></script>
    <!--  窗口滚动导航缩放-->
    <script type="text/javascript" src="Js/scroll.js"></script>
    <!-- 登录注册页面的显示隐藏  -->
  <script type="text/javascript" src="Js/request_logoin_register.js"></script>

    <script type="text/javascript">
      $(function(){
        $('#release_submit').click(function(){
      	    var title_con=$('#title').val();
            var type_con=$('#type').val();
             var context_con=$('#context').val();
            var place_con=$('#place').val();
            var inschool_con=$('#release_form input:radio:checked').val();
             var wktime_con=$('#wktime').val();
            var wages_con=$('#wages').val();
            // var pic_con=$('#pic').val();
             var phone_con=$('#phone').val();
             var exp1_con=$('#exp1').val();
             var exp2_con=$('#exp2').val();
             var exp3_con=$('#exp3').val();
             var exp4_con=$('#exp4').val();
             var exp5_con=$('#exp5').val();
             var exp6_con=$('#exp6').val();
             /*var exp_con=JSON.stringify(
               {"exp1":exp1_con,"exp2":exp2_con,"exp3":exp3_con,"exp4":exp4_con,"exp5":exp5_con,"exp6":exp6_con}
             //   // {exp1:exp1_con,exp2:exp2_con,exp3:exp3_con,exp4:exp4_con,exp5:exp5_con,exp6:exp6_con}
              )//json转换*/
             
            // alert(exp_con)
            
        // $.ajax({ 
        //     url: '../server/work_create.php',
      		//   type: 'POST',
        //     data:{'title':title_con,'type':type_con,'context':context_con,'place':place_con,'inschool':inschool_con,'wktime':wktime_con,'wages':wages_con,'phone':phone_con,'exp':exp_con},
      		//    success:function(data){ 

        //        var obj=eval("("+data+")");
        //        alert(obj.code+obj.msg);
        //     },
        //     error:function(){
        //       alert('发布失败！');
        //     }
      		// });
           $.ajaxFileUpload({
           url:'../server/work_create.php', //你处理上传文件的服务端
           type:"POST",
           secureuri:false,
           data:{'title':title_con,'type':type_con,'context':context_con,'place':place_con,'inschool':inschool_con,'wktime':wktime_con,'wages':wages_con,'phone':phone_con,'exp1':exp1_con,'exp2':exp2_con,'exp3':exp3_con,'exp4':exp4_con,'exp5':exp5_con,'exp6':exp6_con,},
           fileElementId:'file1',
           dataType: 'json',
           success: function(data)
           {
                 if(data=='error'){

                   alert('fail')

                }else{

                  alert('success')
                }
             var obj=eval("("+data+")");
             alert(obj.code)
           }

           })
            

           
        }) 
     
    });
    </script>
     <script type="text/javascript" src="Js/mess.js"></script>
</body>
</html>