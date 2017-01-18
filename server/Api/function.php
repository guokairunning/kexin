<?php


	//创建mysql连接(面向过程方法)
	function mysqlConnect(){ 
		@$con = mysql_connect("localhost","root","199698");
		if (!$con){
		  die('Could not connect: ' . mysql_error());
		}

		mysql_select_db("kx", $con);
		mysql_query("SET NAMES utf8"); 
	}

	//创建mysql连接(面向对象方法)
	function mysqliConnect(){ 
		$conn = new mysqli("localhost","root","199698","kx");
		if (!$conn){
		  die('Could not connect: ' . mysql_error());
		}

		return $conn;
	}

	//获取工作图片
	function getPicture($wkct_id){ 
		$conn = mysqliConnect();//连接数据库
		$query = "set names utf8";
    	$result = $conn->query($query);
    	$query = "SELECT wkct_pic FROM work_content WHERE wkct_id='".$wkct_id."'";
    	$result = $conn->query($query);
    	if($result){
    		for($i = 0; $i < $result->num_rows; $i++){
	    	$picture[] = $result->fetch_assoc();
	    	}
			return $picture['0']['wkct_pic'];
		}
	}

	//计算用户等级
	function getRank($gra_1,$gra_2,$gra_3,$gra_4,$gra_5,$gra_6){
		$grade = $gra_1 + $gra_2 + $gra_3 + $gra_4 + $gra_5 + $gra_6;
		$rank = $grade / 10%100 + 1;
		$need = 10 - $grade % 10;
		$data = array(
			'grade' => $grade,
			'rank' => $rank,
			'need' => $need
			);
		return json_encode($data);
	}

	//判断学生工作状态
	function workstatus($status){ 
		switch($status){
			case '0':{
				$work_status = '正在工作';
				return $work_status;
			}break;
			case '1':{
				$work_status = '预约面试中';
				return $work_status;
			}break;
			case '2':{
				$work_status = '商家拒绝面试';
				return $work_status;
			}break;
			case '3':{
				$work_status = '面试中';
				return $work_status;
			}break;
			case '4':{
				$work_status = '面试不通过';
				return $work_status;
			}break;
			case '5':{
				$work_status = '商家工作结束';
				return $work_status;
			}break;
			case '6':{
				$work_status = '学生工作结束';
				return $work_status;
			}break;
		}
	}
?>