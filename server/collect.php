<?php 
	header("Content-Type: text/html;charset=utf-8");

	//连接数据库
	include_once "./api/function.php";

	session_start();
// {
// //测试数据
// $_SESSION['user_id'] = 1;
// $_SESSION['user_name'] = "sb";

// }
	//拦截非法访问
	if(!isset($_SESSION['user_id'])){
		$return = array(	
	       		'code' => 0,
		       	'data' => "未收藏"
			);
		echo json_encode($return);
    	return ;
	}	

	//判断所有必填信息是否为空
	if(empty($_POST['func'])){
	    $return = array(
	           'code' => -1,
	           'msg' => '请填写所有必填信息',
	    );
	    echo json_encode($return);
	    return ;
	}

	/*创建mysql连接*/
	mysqlConnect();

	//获取所需数据
	$func = $_POST['func'];
	switch ($func) {
		case 'havecoll':
			have_coll();
			break;
		case 'collect':
			collect();
			break;
		case 'delecollect':
			dele_collect();
			break;
		default:
			$return = array(
	           'code' => -2,
	           'msg' => '请求参数错误',
	    );
	    echo json_encode($return);
	    return ;
	}

	//是否收藏
	function have_coll(){
		$wk_id = $_POST['wk_id'];
		//获得登录态 
		$user_id = $_SESSION['user_id'];
		$user_name = $_SESSION['user_name'];
		$sql = "select wkct_id from work_collection where stu_id=$user_id AND wkct_id=$wk_id";
		//echo $sql;
		$result = mysql_query($sql);
		$row = mysql_num_rows($result);
			//var_dump($row);
		if($row != 0){
			$return = array(	
	       		'code' => 1,
		       	'data' => "已收藏"
			);
		}else{
			$return = array(	
	       		'code' => 0,
		       	'data' => "未收藏"
			);
		}
		echo json_encode($return);
    	return ;
	}

	//收藏
	function collect(){
		$wk_id = $_POST['wk_id'];
		$wkct_title = $_POST['wkct_title'];
		$wkct_context = $_POST['wkct_context'];
		$wkct_off = $_POST['wkct_off'];
		//获得登录态 
		$user_id = $_SESSION['user_id'];
		$user_name = $_SESSION['user_name'];
		$sql_hot = "update work_content set wkct_hot=wkct_hot+1 where wkct_id=$wk_id";
		echo $sql_hot;
		$sql = "INSERT INTO work_collection VALUES($user_id,$wk_id,'$wkct_title','$wkct_context',$wkct_off)";
		//echo $sql;
		if(!mysql_query($sql)){
			$return = array(
		           'code' => -6,
		           'msg' => '插入数据失败，请稍后再试',
		    );
		    echo json_encode($return);
		    return ;
		}

		//操作完成，返回正确数据
		$return = array(
	           'code' => 0,
	           'msg' => '收藏成功',
	    );
	    echo json_encode($return);
	    return ;
	}	

	//取消收藏
	function dele_collect(){
		$wk_id = $_POST['wk_id'];
		//获得登录态 
		$user_id = $_SESSION['user_id'];
		$user_name = $_SESSION['user_name'];
		$sql = "DELETE from work_collection where stu_id=$user_id AND wkct_id=$wk_id";
		//echo $sql;
		if(!mysql_query($sql)){
			$return = array(
		           'code' => -6,
		           'msg' => '删除数据失败，请稍后再试',
		    );
		    echo json_encode($return);
		    return ;
		}

		//操作完成，返回正确数据
		$return = array(
	           'code' => 0,
	           'msg' => '取消收藏成功',
	    );
	    echo json_encode($return);
	    return ;
	}

?>
