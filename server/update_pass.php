<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
     
     $user_name=$_POST['email'];
     $user_pass=md5($_POST['password']);
     $user_code=$_POST['code'];
     $table=$_GET['table'];
     $user=$_GET['user'];
     $pass=$_GET['pass'];
     $code=$_GET['code'];
     $conn=new mysqli("localhost","root","","kx");     
     $sql="select * from $table where $user='".$user_name."' and $code='".$user_code."'";
     $result=$conn->query($sql);
     $_num=$result->num_rows; 

     if($_num){
         $sql_up="update $table set $pass='".$user_pass."' where $user='".$user_name."'";
         $result_up=$conn->query($sql_up);
         $num=$result->num_rows;
         if($num){
     	    $return = array(
               'code' => 0,
               'msg' => '修改成功',
             );
            echo json_encode($return);
            return ;
         }
     	 else{
     		$return = array(
               'code' => -1,
               'msg' => '修改失败',
             );
            echo json_encode($return);
            return ;
     	 }
     }
     else{
      	 $return = array(
               'code' => 0,
               'msg' => '用户名或验证码错误',
             );
            echo json_encode($return);
            return ; 
     }
     echo '<a href="../client2.0/index.php">回到主页</a>';
?>