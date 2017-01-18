<?php
	session_start();
	//图片存储API
	include_once "./api/apiClass.php";

	
	//连接数据库
	include_once "./api/function.php";
	$conn = mysqliConnect();

	//设置数据库字符集
	$query = "set names utf8";
	$result = $conn->query($query);
	
	//获取商家注册信息
	$buss_nickname = $_POST['username'];//昵称
	$buss_email = $_POST['email'];//注册邮箱
	$password = md5($_POST['password']);//对密码进行md5加密
	$buss_company_name = $_POST['bus_name'];//公司名称
	//var_dump($_POST);
	//存储图片
	$picUrl = "./uploads/bus_picture/";
	$picApi = new pictureApi($picUrl);
	$picReturn = $picApi->upload();
	/*存储失败则返回错误信息*/
	if($picReturn['code'] != 0){
		echo json_encode($picReturn);
		return ;
	}
	$pic = $picReturn['filename'];
	$query = "INSERT INTO buss_login (buss_email,buss_passwd,buss_nickname,buss_audit_data,buss_company_name) VALUES('".$buss_email."','".$password."','".$buss_nickname."','".$pic."','".$buss_company_name."')";
	$result = $conn->query($query);
	if($result){
		$query = "SELECT buss_id FROM buss_login WHERE buss_email='".$buss_email."'";
	    $result = $conn->query($query);
	    for($i = 0; $i < $result->num_rows; $i++){
	        $bussid[] = $result->fetch_assoc();
	    }
		$return = array(
	           'code' => 0,
	           'msg' => '注册成功',
	   		 );
		
	   	echo json_encode($return);
	    return ;
	}
	else{
		$return = array(
	           'code' => -1,
	           'msg' => '该邮箱已被注册',
	   		 );
	   	 	echo json_encode($return);
	    	return ;
	}
	$conn->close();
?>