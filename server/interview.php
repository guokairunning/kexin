<?php 
	header("Content-Type: text/html;charset=utf-8");

	//连接数据库
	include_once "./api/function.php";
	//图片存储API
	include_once "./api/apiClass.php";

	session_start();

	//拦截非法访问
	if(!isset($_SESSION['user_id'])){
		$return = array(
	           'code' => -10,
	           'msg' => '请先登录',
	    );
	    echo json_encode($return);
	    return ;
	}	
	/*创建mysql连接*/
	mysqlConnect();

	//判断请求方法
	if(empty($_POST['func'])){
		$return = array(
	       'code' => -1,
	       'msg' => '访问参数出错',
		);
		echo json_encode($return);
    	return ;
	}

	//$status = 1;

	$func = $_POST['func'];
	switch ($func) {
		case 'endworkbuss':
			end_work_buss();
			break;
		case 'refuseinterview':
			refuse_interview();
			break;
		case 'agreeinterview':
			agree_interview();
			break;
		case 'adoptinterview':
			adopt_interview();
			break;
		case 'notadoptinterview':
			notadopt_interview();
			break;
		case 'endworkstu':
			end_work_stu();
			break;
		case 'applyinterview':
			apply_interview();
			break;
		default:
			$return = array(
		       	'code' => -1,
		       	'data' => "访问参数出错"
		)	;
	}
	
	//商家结束工作
	function end_work_buss(){
		/*返回结果变量*/
		$return = array();
		if(empty($_POST['wkct_id']) || empty($_POST['stu_id'])){
			$return = array(
	           'code' => -1,
	           'msg' => '访问参数出错',
	   		 );
	   	 	echo json_encode($return);
	    	return ;
		}
		$wkct_id = $_POST['wkct_id'];
		$stu_id = $_POST['stu_id'];
		//update working set status=5
		/*这里存在漏洞，如果用户直接修改了前端的代码，则他可以强制修改不属于自己的信息，解决方法是先判断wkct_id是否属于当前session用户*/
		$sql = "update working set wk_status = 5 where wkct_id=$wkct_id AND stu_id=$stu_id ";
		$result = mysql_query($sql);
		
		//发送消息呢
		$user_name = $_SESSION['user_name'];
		$mess_belong_id = $stu_id;
		$mess_content = "$user_name 商家以结束了您的工作，恭喜您，工作完成，能力已帮您成长";
		$mess = new messageApi($mess_belong_id, $mess_content);
		$mess->sendMessage();

		//增加经验
		/*取出该工作设置的能力值*/
		$result_exp = mysql_query("SELECT wkct_exp FROM work_content where wkct_id=$wkct_id limit 1");
		while($row = mysql_fetch_array($result_exp)){
		  $wkct_exp = $row['wkct_exp'];
	  	}
	  	$wkct_exp = json_decode($wkct_exp,1);
	  	/*为该学生增加成绩*/
	  	$result_exp = mysql_query("SELECT stu_exp FROM student_info where stu_id=$stu_id limit 1");
		while($row = mysql_fetch_array($result_exp)){
		  $stu_exp = $row['stu_exp'];
	  	}
	  	$stu_exp = json_decode($stu_exp,1);
	  	$stu_exp['exp1'] += $wkct_exp['exp1'];
	  	$stu_exp['exp2'] += $wkct_exp['exp2'];
	  	$stu_exp['exp3'] += $wkct_exp['exp3'];
	  	$stu_exp['exp4'] += $wkct_exp['exp4'];
	  	$stu_exp['exp5'] += $wkct_exp['exp5'];
	  	$stu_exp['exp6'] += $wkct_exp['exp6'];
	  	/*更新该学生新经验*/
	  	//这里并没有加商家打分环节，而是直接把该工作所有分直接全部给了该学生，后期可以改进该功能
	  	$stu_exp = json_encode($stu_exp);
	  	$sql = "update student_info set stu_exp = '$stu_exp' where stu_id=$stu_id";
	  	//echo $sql;
		$result = mysql_query($sql);
		
		$return = array(
	       	'code' => 0,
	       	'data' => $return
		);
		echo json_encode($return);

		return ;
	}	

	//商家拒绝面试
	function refuse_interview(){
		/*返回结果变量*/
		$return = array();

		if(empty($_POST['wkct_id']) || empty($_POST['stu_id'])){
			$return = array(
	           'code' => -1,
	           'msg' => '访问参数出错',
	   		 );
	   	 	echo json_encode($return);
	    	return ;
		}
		$wkct_id = $_POST['wkct_id'];
		$stu_id = $_POST['stu_id'];
		//update working set status=2
		/*这里存在漏洞，如果用户直接修改了前端的代码，则他可以强制修改不属于自己的信息，解决方法是先判断wkct_id是否属于当前session用户*/
		$sql = "update working set wk_status = 2 where wkct_id=$wkct_id AND stu_id=$stu_id ";
		$result = mysql_query($sql);
		
		//发送消息呢
		$user_name = $_SESSION['user_name'];
		$mess_belong_id = $stu_id;
		$mess_content = "$user_name 商家拒绝了您的面试申请";
		$mess = new messageApi($mess_belong_id, $mess_content);
		$mess->sendMessage();

		$return = array(
	       	'code' => 0,
	       	'data' => $return
		);
		echo json_encode($return);

		return ;

	}	

	//商家同意面试，面试进行中
	function agree_interview(){
		/*返回结果变量*/
		$return = array();

		if(empty($_POST['wkct_id']) || empty($_POST['stu_id']) || empty($_POST['interview_data'])){
			$return = array(
	           'code' => -1,
	           'msg' => '访问参数出错',
	   		 );
	   	 	echo json_encode($return);
	    	return ;
		}
		$wkct_id = $_POST['wkct_id'];
		$stu_id = $_POST['stu_id'];
		$interview_data = $_POST['interview_data'];
		//update working set status=3
		/*这里存在漏洞，如果用户直接修改了前端的代码，则他可以强制修改不属于自己的信息，解决方法是先判断wkct_id是否属于当前session用户*/
		$sql = "update working set wk_status = 3 where wkct_id=$wkct_id AND stu_id=$stu_id ";
		$result = mysql_query($sql);
		
		//发送消息呢
		$user_name = $_SESSION['user_name'];
		$mess_belong_id = $stu_id;
		$mess_content = "$user_name 商家已同意您的面试申请，请尽快进来面试<br/> $interview_data";
		$mess = new messageApi($mess_belong_id, $mess_content);
		$mess->sendMessage();

		$return = array(
	       	'code' => 0,
	       	'data' => $return
		);
		echo json_encode($return);

		return ;
	
	}	

	//面试通过，正在工作中
	function adopt_interview(){
		/*返回结果变量*/
		$return = array();

		if(empty($_POST['wkct_id']) || empty($_POST['stu_id'])){
			$return = array(
	           'code' => -1,
	           'msg' => '访问参数出错',
	   		 );
	   	 	echo json_encode($return);
	    	return ;
		}
		$wkct_id = $_POST['wkct_id'];
		$stu_id = $_POST['stu_id'];
		//update working set status=0
		/*这里存在漏洞，如果用户直接修改了前端的代码，则他可以强制修改不属于自己的信息，解决方法是先判断wkct_id是否属于当前session用户*/
		$sql = "update working set wk_status = 0 where wkct_id=$wkct_id AND stu_id=$stu_id ";
		$result = mysql_query($sql);
		
		//发送消息呢
		$user_name = $_SESSION['user_name'];
		$mess_belong_id = $stu_id;
		$mess_content = "$user_name 商家的工作您已经通过面试，开始工作吧";
		$mess = new messageApi($mess_belong_id, $mess_content);
		$mess->sendMessage();

		$return = array(
	       	'code' => 0,
	       	'data' => $return
		);
		echo json_encode($return);

		return ;

	}	

	//面试不通过
	function notadopt_interview(){
		/*返回结果变量*/
		$return = array();

		if(empty($_POST['wkct_id']) || empty($_POST['stu_id'])){
			$return = array(
	           'code' => -1,
	           'msg' => '访问参数出错',
	   		 );
	   	 	echo json_encode($return);
	    	return ;
		}
		$wkct_id = $_POST['wkct_id'];
		$stu_id = $_POST['stu_id'];
		//update working set status=4
		/*这里存在漏洞，如果用户直接修改了前端的代码，则他可以强制修改不属于自己的信息，解决方法是先判断wkct_id是否属于当前session用户*/
		$sql = "update working set wk_status = 4 where wkct_id=$wkct_id AND stu_id=$stu_id ";
		$result = mysql_query($sql);
		
		//发送消息呢
		$user_name = $_SESSION['user_name'];
		$mess_belong_id = $stu_id;
		$mess_content = "$user_name 商家的面试您没能通过，再看看其他工作吧";
		$mess = new messageApi($mess_belong_id, $mess_content);
		$mess->sendMessage();

		$return = array(
	       	'code' => 0,
	       	'data' => $return
		);
		echo json_encode($return);

		return ;
	}	

	//学生结束工作
	function end_work_stu(){
		/*返回结果变量*/
		$return = array();

		if(empty($_POST['wkct_id']) ){
			$return = array(
	           'code' => -1,
	           'msg' => '访问参数出错',
	   		 );
	   	 	echo json_encode($return);
	    	return ;
		}
		$wkct_id = $_POST['wkct_id'];
		$stu_id = $_SESSION['stu_id'];
		//update working set status=6
		/*这里存在漏洞，如果用户直接修改了前端的代码，则他可以强制修改不属于自己的信息，解决方法是先判断wkct_id是否属于当前session用户*/
		$sql = "update working set wk_status = 6 where wkct_id=$wkct_id AND stu_id=$stu_id ";
		$result = mysql_query($sql);
		
		$return = array(
	       	'code' => 0,
	       	'data' => $return
		);
		echo json_encode($return);

		return ;
	}	

	//学生预约面试
	function apply_interview(){
		/*返回结果变量*/
		$return = array();
		//var_dump($_POST);

		$stu_id = $_SESSION['user_id'];
		
		$conn = mysqliConnect();//连接数据库
		$query = "set names utf8";
		$result = $conn->query($query);
		$wkct_id = $_POST['wkct_id'];//获取工作id
		$wkct_people_name = $_POST['wkct_people_name'];//获取发布人昵称
		$wkct_title = $_POST['wkct_title'];//获取工作标题
		
		$query = "INSERT INTO working (stu_id,wkct_id,wkct_people_name,wk_status,wkct_title) VALUES('".$stu_id."','".$wkct_id."','".$wkct_people_name."',1,'".$wkct_title."')";
		//echo $query;
		$result = $conn->query($query);
		if($result){
			$return = array(
		           'code' => 0,
		           'msg' => '已帮您预约面试，请等待商家通知',
		   		 );
		   	echo json_encode($return);
		}
		else{
			$return = array(
		           'code' => -2,
		           'msg' => '面试已申请',
		   		 );
		   	echo json_encode($return);
		}
		
	}


?>
