<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>修改密码</title>

    <!-- Bootstrap -->
    <link href="../client2.0/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
    #do_pass{
      width:400px;
      height:400px;
      margin:100px auto;
    }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
           <form action="update_pass.php?table=<?php echo $_GET['table']; ?>&user=<?php echo $_GET['user']; ?>&pass=<?php echo $_GET['pass']; ?>&code=<?php echo $_GET['code']; ?>" method="POST"  id="do_pass" >
            <div class="form-group">
              <input type="email" name="email"  class="form-control" placeholder="输入注册邮箱" >
            </div>
            <div class="form-group">             
              <input type="text" name="code"  class="form-control" placeholder="请输入验证码" >
             </div>
            <div class="form-group">
              <input type="password" name="password"  class="form-control" placeholder="密码" >
            </div>
            <div class="form-group">
              <input type="password"   class="form-control" placeholder="确认密码" >
            </div>
            <div class="form-group">             
              <input type="submit" name="submit"  class="form-control" placeholder="确认修改" >
             </div>
            </form>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../client/Js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../client/js/bootstrap.min.js"></script>
    <script src="../client/Js/check.js"></script>
  </body>
</html>