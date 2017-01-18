<?php 
	header("Content-Type: text/html;charset=utf-8");

	//图片存储API
	include_once "./api/apiClass.php";
	//连接数据库
	include_once "./api/function.php";

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


	//判断所有必填信息是否为空
	if(empty($_POST['title']) || empty($_POST['place']) || empty($_POST['wktime']) || empty($_POST['phone']) || empty($_POST['wages']) || empty($_POST['context']) || empty($_POST['type']) || !isset($_POST['inschool']) || empty($_POST['exp1'])){
	    $return = array(
	           'code' => -5,
	           'msg' => '请填写所有必填信息',
	    );
	    echo json_encode($return);
	    return ;
	}

	//从表单中获取所需数据
	$title = $_POST['title'];
	$place = $_POST['place'];
	$wktime = $_POST['wktime'];
	$phone = $_POST['phone'];
	$wages = $_POST['wages'];
	$context = $_POST['context'];
	$type = $_POST['type'];
	$inschool = $_POST['inschool'];
	$exp1 = $_POST['exp1'];
	$exp2 = $_POST['exp2'];
	$exp3 = $_POST['exp3'];
	$exp4 = $_POST['exp4'];
	$exp5 = $_POST['exp5'];
	$exp6 = $_POST['exp6'];
	//var_dump($_POST);
	$exp = array(
				"exp1" => $exp1,
				"exp2" => $exp2,
				"exp3" => $exp3,
				"exp4" => $exp4,
				"exp5" => $exp5,
				"exp6" => $exp6,
			);
	$exp = json_encode($exp);
	//从session中获取所需数据
	$people_id = $_SESSION['user_id'];
	$people_name = $_SESSION['user_name'];

	//存储图片
	$picUrl = "./uploads/work_content/";
	$picApi = new pictureApi($picUrl);
	$picReturn = $picApi->upload();
	/*存储失败则返回错误信息*/
	//$picReturn = "F:\wamp\www\kx1.0\server\uploads\work_content";
	if($picReturn['code'] != 0){
		echo json_encode($picReturn);
		return ;
	}
	$pic = $picReturn['filename'];
	//插入数据库
	/*创建mysql连接*/
	mysqlConnect();
	$sql = "INSERT INTO work_content(wkct_title,wkct_people_id,wkct_peopel_name,wkct_place,wkct_wktime,wkct_phone,wkct_wages,wkct_context,wkct_type,wkct_inschool,wkct_pic,wkct_exp) VALUES ('".$title."',".$people_id.",'".$people_name."','".$place."','".$wktime."',".$phone.",'".$wages."','".$context."','".$type."',".$inschool.",'".$pic."','".$exp."')";
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
           'msg' => '发布成功',
    );
    echo json_encode($return);
    return ;
?>
