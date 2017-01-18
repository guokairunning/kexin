<?php 
	header("Content-Type: text/html;charset=utf-8");
	session_start();
	session_unset();
	echo "<script>alert('已退出登录');window.location='../client2.0/index.php'</script>";


?>