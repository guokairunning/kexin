<?php 
	header("content-type:text/html;charset=utf-8");
	include_once "./api/function.php";
	session_start();
	$wkct_id = $_GET['wkct_id'];
	$stu_id = $_SESSION['user_id'];
	$stu_nickname = $_SESSION['user_name'];
	if(!empty($stu_id)){
		$conn = mysqliConnect();//连接数据库
		$query = "set names utf8";
		$result = $conn->query($query);
		$query = "DELETE from work_collection WHERE stu_id='".$stu_id."' AND wkct_id='".$wkct_id."'";
		$result = $conn->query($query);
	}

	//成功后
	echo "<script>alert('取消收藏');history.go(-1)</script>";
?>