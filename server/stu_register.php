<?php
	//连接数据库
	include_once "./api/function.php";
	session_start();
	$conn = mysqliConnect();

	//设置数据库字符集
	$query = "set names utf8";
	$result = $conn->query($query);
	
	//获取学生注册信息
	$stu_nickname = $_POST['username'];//昵称
	$email = $_POST['email'];//注册邮箱
	$password = md5($_POST['password']);//对密码进行md5加密
	$query = "INSERT INTO student_login (stu_nickname,stu_email,stu_paswd) VALUES('".$stu_nickname."','".$email."','".$password."')";
	$result = $conn->query($query);
	if($result){
		$query = "SELECT stu_id FROM student_login WHERE stu_email='".$email."'";
	    $result = $conn->query($query);
	    for($i = 0; $i < $result->num_rows; $i++){
	        $stuid[] = $result->fetch_assoc();
	    }
		$query = "INSERT INTO student_info (stu_id,stu_head) VALUES('".$stuid['0']['stu_id']."','../client2.0/Images/you.jpg')";
		$result = $conn->query($query);
		$return = array(
	           'code' => 0,
	           'msg' => '注册成功',
	   		 );
		$_SESSION['user_id'] = $stuid['0']['stu_id'];
		$_SESSION['user_name'] = $stu_nickname;
		$_SESSION['user_type'] = 1;
	   	echo json_encode($return);
	}
	else{
		$return = array(
	           'code' => -1,
	           'msg' => '该邮箱已被注册',
	   		 );
	   	 	echo json_encode($return);
	}
	$conn->close();
?>