<?php
/**
* by www.phpddt.com
*/
header("content-type:text/html;charset=utf-8");
ini_set("magic_quotes_runtime",0);
require_once 'class.phpmailer.php';

class mail{

	function init_mail(){
		try{
			$mail = new PHPMailer(true); 
			$mail->IsSMTP();
			$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
			$mail->SMTPAuth   = true;                  //开启认证
			$mail->Port       = 25;                    
			$mail->Host       = "smtp.163.com"; 
			$mail->Username   = "liulonghang123@qq.com";    
			$mail->Password   = "liulonghang..";            
			//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
			$mail->AddReplyTo("liulonghang123@qq.com","刘龙航");//回复地址
			$mail->From       = "liulonghang123@qq.com";
			$mail->FromName   = "我在测试";
			$to = "chailu_try@163.com";
			$mail->AddAddress($to,"cl");
			$mail->Subject  = "phpmailer测试标题";
			$mail->Body = "<h1>phpmail演示</h1>这是php点点通（<font color=red>www.phpddt.com</font>）对phpmailer的测试内容";
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!测试"; //当邮件不支持html时备用显示，可以省略
			$mail->WordWrap   = 80; // 设置每行字符串的长度
			//$mail->AddAttachment("f:/test.png");  //可以添加附件
			$mail->IsHTML(true); 
			$mail->Send();
			echo '邮件已发送';
		}catch (phpmailerException $e) {
			echo "邮件发送失败：".$e->errorMessage();
		}

	}

}

?>