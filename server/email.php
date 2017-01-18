<?php
/**
* by www.phpddt.com
*/
//
   require 'class.phpmailer.php';
   header("content-type:text/html;charset=utf-8");
   ini_set("magic_quotes_runtime",0);
   $conn=new mysqli("localhost","root","","kx");
   $code = "";
   for ($i = 0; $i < 4; $i++){
       $code .= rand(0, 9);
   }

   $user_type=$_POST['type'];
   $user_name=$_POST['email'];

           switch ($user_type) {
           	case '1':{
                      $sql="select * from student_login where stu_email='".$user_name."'";
                      $result=$conn->query($sql);
                      $table="student_login";
                      $user="stu_email";
                      $pass="stu_paswd";
                      $verify="stu_code";
                   }break;
           	case '2':{                     
                      $sql="select * from buss_login where buss_email='".$user_name."'";
                      $result=$conn->query($sql);
           	          $table="buss_login";
           	          $user="buss_email";
                      $pass="buss_passwd";
                      $verify="buss_code";
           	       }break;

            case '3':{
                      $sql="select * from sup_admin where sup_email='".$user_name."'";
                      $result=$conn->query($sql);
           	          $table="super_admin";
           	          $user="sup_email";
                      $pass="sup_passwd";
                      $verify="sup_code";
           	       }break;
           	   }
if($result->num_rows){
try {
	$mail = new PHPMailer(true); 
	$mail->IsSMTP();
	$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
	$mail->SMTPAuth   = true;                  //开启认证
	$mail->Port       = 25;                    
	$mail->Host       = "smtp.163.com"; 
	$mail->Username   = "15102944917@163.com";    
	$mail->Password   = "long15091143082";            
	//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
	$mail->AddReplyTo("15102944917@163.com","刘龙航");//回复地址
	$mail->From       = "15102944917@163.com";
	$mail->FromName   = "可辛";
	$to = "$user_name";
	$mail->AddAddress($to);
	$mail->Subject  = "修改密码！！";
	//$mail->Body = "<h1>phpmail演示</h1>进入修改页面</a>验证码:$code";
	$mail->MsgHTML("<a href='http://localhost/kx2.0/server/do_pass.php?table=$table&user=$user&pass=$pass&code=$verify'>进入修改页面</a>验证码:$code");
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!测试"; //当邮件不支持html时备用显示，可以省略
	$mail->WordWrap   = 80; // 设置每行字符串的长度
	//$mail->AddAttachment("f:/test.png");  //可以添加附件
	$mail->IsHTML(true); 
	$mail->Send();
	$sql="update $table set $verify='".$code."' where $user='".$user_name."'";
  $conn->query($sql);
	echo '邮件已发送,请注意查收！'."<br/>";
	echo '<a href="../client/index.html">回到主页</a>';
	
} catch (phpmailerException $e) {
	echo "邮件发送失败：".$e->errorMessage();
  echo '<a href="../client/index.html">回到主页</a>';
}
}
else {
   echo "用户账户不存在!";
   echo '<a href="../client/index.html">回到主页</a>';
} 
?>