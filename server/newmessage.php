<?php     //获取未读消息条数
	include_once "./api/function.php";
	session_start();
	$stu_id = $_SESSION['user_id'];
	$stu_nickname = $_SESSION['user_name'];
//var_dump($_SESSION);	
	if(!empty($stu_id)){
		$conn = mysqliConnect();//连接数据库
		$query = "set names utf8";
		$result = $conn->query($query);
		$query = "SELECT * FROM message WHERE mess_belong_id='".$stu_id."' AND mess_haveread=0";
		//	echo $query;
		$result = $conn->query($query);
		if($result){
			$row = $result->num_rows;
			$return = array(
		       	'code' => 0,
		       	'data' => $row
			);
			echo json_encode($return);
		}
		else{
			$return = array(
		       	'code' => -1,
		       	'msg' => '获取失败'
			);
			echo json_encode($return);
		}
		$conn->close();
	}
	else{
		header("location: ----");
	}
?>