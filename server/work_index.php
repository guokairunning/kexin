<?php 
	header("Content-Type: text/html;charset=utf-8");

	//连接数据库
	include_once "./api/function.php";

	/*创建mysql连接*/
	mysqlConnect();

	//判断请求方法
	if(empty($_GET['func'])){
		$return = array(
	       'code' => -1,
	       'msg' => '访问参数出错',
		);
		echo json_encode($return);
    	return ;
	}
	$func = $_GET['func'];
	switch ($func) {
		case 'type':
			search_type();
			break;
		case 'name':
			search_name();
			break;
		case 'index':
			search_index();
			break;
		default:
			search_index();
	}
	

	function search_type(){
		/*返回结果变量*/
		$return = array();

		if(empty($_GET['wk_type'])){
			$return = array(
	           'code' => -1,
	           'msg' => '访问参数出错',
	   		 );
	   	 	echo json_encode($return);
	    	return ;
		}
		$wk_type = $_GET['wk_type'];
		$sql = "select wkct_id,wkct_title,wkct_peopel_name,wkct_pic	,wkct_wages from work_content where wkct_type='".$wk_type."' ";

		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)){
			$return[] = $row;
		}
		$return = array(
	       	'code' => 0,
	       	'data' => $return
		);
		echo json_encode($return);
    	return ;
	}

	function search_name(){
		/*返回结果变量*/
		$return = array();
//var_dump($_GET);
		if(empty($_GET['wk_name'])){
			$return = array(
	           'code' => -1,
	           'msg' => '访问参数出错',
	   		 );
	   	 	echo json_encode($return);
	    	return ;
		}
		$wk_name = $_GET['wk_name'];

		//不带参数，采用默认排序
		if(empty($_GET['sort'])){
			search_name_index($wk_name);
			return ;
		}
		
		if($_GET['sort']=='hot'){
			$sql = "select wkct_id,wkct_title,wkct_peopel_name,wkct_wages,wkct_pic,wkct_hot from work_content where wkct_title like '%".$wk_name."%' order by wkct_hot DESC";
		}else{
			$sql = "select wkct_id,wkct_title,wkct_peopel_name,wkct_wages,wkct_pic,wkct_createtime from work_content  where wkct_title like '%".$wk_name."%' order by wkct_createtime DESC";
		}		
		$result = mysql_query($sql);
		//echo $sql;
		while($row = mysql_fetch_array($result)){
			$return[] = $row;
		}
		$return = array(
	       	'code' => 0,
	       	'data' => $return
		);
		echo json_encode($return);
		return ;
	}

	function search_index(){
		/*返回结果变量*/
		$return = array();

		if(!isset($_GET['inschool'])){
			$return = array(
	           'code' => -111,
	           'msg' => '访问参数出错',
	   		 );
	   	 	echo json_encode($return);
	    	return ;
		}
		$inschool = $_GET['inschool'];	
		if($inschool == 0){
			$sch = "where wkct_inschool = 0";
		}else{
			$sch = "where wkct_inschool = 1";
		}
		


		//计算hot及时间的排序,降序排列
		$sql = "select wkct_id,wkct_title,wkct_peopel_name,wkct_wages,wkct_pic,wkct_createtime,wkct_hot from work_content $sch order by wkct_hot DESC";
		$result = mysql_query($sql);
		$rank = 1;
		while($row = mysql_fetch_array($result)){
			$row['rank_hot'] = $rank;
			$return_hot[] = $row;
			$rank++;
		}
		$sql = "select wkct_id,wkct_title,wkct_peopel_name,wkct_wages,wkct_pic,wkct_createtime,wkct_hot from work_content $sch order by wkct_createtime DESC";
		$result = mysql_query($sql);
		$rank = 1;
		while($row = mysql_fetch_array($result)){
			/*找到当前行row在return_hot中对应的数据行并为rank_time赋值*/
			for($i=0; $i<count($return_hot); $i++){
				if($return_hot[$i]['wkct_id'] == $row['wkct_id']){
					$return_hot[$i]['rank_time'] = $rank;
					break;
				}
			}
			$rank++;
		}

		//计算综合序列
		for($i=0; $i<count($return_hot); $i++){
			$return_hot[$i]['rank_common'] = $return_hot[$i]['rank_hot']*0.7 + $return_hot[$i]['rank_time']*0.3;
		}

		//根据综合分对数据进行排序
		foreach ($return_hot as $key=>$value){
		    $id[$key] = $value['rank_common'];
		    
		}
 		array_multisort($id,SORT_NUMERIC,SORT_ASC,$return_hot);
		
 		//返回正确数据
		$return = array(
	       	'code' => 0,
	       	'data' => $return_hot
		);
		echo json_encode($return);
    	return ;	
	}

	function search_name_index($wk_name){
		/*返回结果变量*/
		$return = array();

		//计算hot及时间的排序,降序排列
		$sql = "select wkct_id,wkct_title,wkct_peopel_name,wkct_wages,wkct_pic,wkct_createtime,wkct_hot from work_content  where wkct_title like '%".$wk_name."%'  order by wkct_hot DESC";
		//echo $sql;
		$result = mysql_query($sql);
		$rank = 1;
		while($row = mysql_fetch_array($result)){
			$row['rank_hot'] = $rank;
			$return_hot[] = $row;
			$rank++;
		}
		$sql = "select wkct_id,wkct_title,wkct_peopel_name,wkct_wages,wkct_pic,wkct_createtime,wkct_hot from work_content  where wkct_title like '%".$wk_name."%' order by wkct_createtime DESC";
		$result = mysql_query($sql);
		$rank = 1;
		while($row = mysql_fetch_array($result)){
			/*找到当前行row在return_hot中对应的数据行并为rank_time赋值*/
			for($i=0; $i<count($return_hot); $i++){
				if($return_hot[$i]['wkct_id'] == $row['wkct_id']){
					$return_hot[$i]['rank_time'] = $rank;
					break;
				}
			}
			$rank++;
		}

		//计算综合序列
		for($i=0; $i<count($return_hot); $i++){
			$return_hot[$i]['rank_common'] = $return_hot[$i]['rank_hot']*0.7 + $return_hot[$i]['rank_time']*0.3;
		}

		//根据综合分对数据进行排序
		foreach ($return_hot as $key=>$value){
		    $id[$key] = $value['rank_common'];
		    
		}
			array_multisort($id,SORT_NUMERIC,SORT_ASC,$return_hot);
		
			//返回正确数据
		$return = array(
	       	'code' => 0,
	       	'data' => $return_hot
		);
		echo json_encode($return);
		return ;	
	}
?>
