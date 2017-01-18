<?php     //超级管理员审核商家注册
	include_once "./api/function.php";
	session_start();
	// $sup_id = $_SESSION['----'];
	// $sup_nickname = $_SESSION['----'];
	$sup_id = 1;

	if(!empty($sup_id)){
		$conn = mysqliConnect();//连接数据库
		$query = "set names utf8";
		$result = $conn->query($query);
		$query = "SELECT buss_id,buss_audit_data,buss_company_name FROM buss_login WHERE buss_status=0";
		//echo $query;
		$result = $conn->query($query);
		if($result){
			for($i = 0; $i < $result->num_rows; $i++){
				$buss[] = $result->fetch_assoc();
			}
			$return = array(
		       	'code' => 0,
		       	'data' => $buss
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