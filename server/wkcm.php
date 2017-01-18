<?php
 header("content-type:text/html;charset=utf-8");
    session_start();

	if(!isset($_SESSION['user_id'])){
		echo "<script>alert('未登录');history.go(-1)</script>"; 
		return  ;
	}
    $wkct_id=$_GET['id'];



     $user_id=$_SESSION['user_id'];
     $user_name=$_SESSION['user_name'];
    $conn=new mysqli("localhost","root","199698","kx");
    $query = "set names utf8";
    $result = $conn->query($query); 
	if(@isset($_POST['content'])){

	    $sql="INSERT INTO wk_comment(wkcm_stu_id,wkcm_nickname,wkcm_content,wkct_id) VALUES ($user_id,'".$user_name."','".$_POST['content']."',$wkct_id)";
	    if($conn->query($sql)){   //将评论内容插入到对应表中
	       //header("location:../server/job.php");
	    	echo "<script>alert('成功');history.go(-1)</script>"; 
	    	header("location:job.php?id=$wkct_id");
	    }
	}
 ?>
