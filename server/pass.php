<?php     //超级管理员设置商家注册申请通过
	include_once "./api/function.php";

	$conn = mysqliConnect();//连接数据库
	$query = "set names utf8";
	$result = $conn->query($query);
	$buss_id = $_POST['buss_id'];//获取商家id
	$query = "UPDATE buss_login SET buss_status=1 WHERE buss_id='".$buss_id."'";
	$result = $conn->query($query);
	if($result){
		$return = array(
		    'code' => 0,
		    'data' => '设置通过成功'
		);
		echo json_encode($return);
	}
	else{
		$return = array(
		    'code' => -1,
		    'msg' => '设置通过失败'
		);
		echo json_encode($return);
	}
	$conn->close();
?>