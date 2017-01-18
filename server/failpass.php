<?php     //超级管理员否决商家注册申请
	include_once "./api/function.php";

	$conn = mysqliConnect();//连接数据库
	$query = "set names utf8";
	$result = $conn->query($query);
	$buss_id = $_POST['buss_id'];//获取商家id
	$query = "DELETE FROM buss_login WHERE buss_id='".$buss_id."'";
	$result = $conn->query($query);
	if($result){
		$return = array(
		    'code' => 0,
		    'data' => '否决成功'
		);
		echo json_encode($return);
	}
	else{
		$return = array(
		    'code' => -1,
		    'msg' => '否决失败'
		);
		echo json_encode($return);
	}
	$conn->close();
?>