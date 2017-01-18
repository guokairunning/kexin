<?php     //商家查看工作申请人
	include_once "./api/function.php";
	session_start();
	$buss_id = $_SESSION['user_id'];
	$buss_nickname = $_SESSION['user_name'];
	if(!empty($buss_id)){
		$conn = mysqliConnect();//连接数据库
		$query = "set names utf8";
		$result = $conn->query($query);
		$query = "SELECT * FROM working WHERE wkct_people_name='".$buss_nickname."'";
		//echo $query;
		$result = $conn->query($query);
		$work = array();
		if($result){
			for($i = 0; $i < $result->num_rows; $i++){
				$work[] = $result->fetch_assoc();
			}
			$return = array(
		       	'code' => 0,
		       	'data' => $work
			);
			echo json_encode($return);
		}
		else{
			$return = array(
		       	'code' => -1,
		       	'msg' => '查看失败'
			);
			echo json_encode($return);
		}
		$conn->close();
	}
	else{
		header("location: ----");
	}
?>