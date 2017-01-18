
<?php
   header("Content-Type: text/html;charset=utf-8");
   session_start();   //用于用户SESSION的保存.
   $flag=0;
         $user_name=trim($_POST['username']);
         $user_pass=md5($_POST['password']);
         $user_code=trim($_POST['code']);
         $user_type=$_POST['type'];
         $conn=new mysqli("localhost","root","199698","kx"); 
         $query = "set names utf8";
         $result = $conn->query($query);
          $pass_status = 0;
           switch ($user_type) {
            case '1':{
                      $sql="select * from student_login where stu_email='".$user_name."'";
                      $result=$conn->query($sql);
                      $num=$result->num_rows;
                      if($num){
                         $row=$result->fetch_object();
                         $name=$row->stu_email;
                         $pass=$row->stu_paswd;
                       $_SESSION['user_id']=$row->stu_id;
                       $_SESSION['user_name']=$row->stu_nickname;
                       $_SESSION['user_type']=1;
                      }

                     
                      else{
                           $return = array(
                           'code' => 0,
                           'msg' => '该用户不存在',
                            );
                            echo json_encode($return);
                            return ;
                      } 
                   }break;
            case '2':{                     
                      $sql="select * from buss_login where buss_email='".$user_name."'";
                      $result=$conn->query($sql);
                      $num=$result->num_rows;
                      $pass_status = 1;
                      if($num){
                         $row=$result->fetch_object();
                         $name=$row->buss_email;
                         if($row->buss_status == 1){
                          $pass_status=0;
                         } 
                         $pass = $row->buss_passwd;
                       $_SESSION['user_id']=$row->buss_id;
                       $_SESSION['user_name']=$row->buss_nickname;
                       $_SESSION['user_type']=2;
                      
                    }
                      
                      else{
                        $return = array(
                        'code' => 0,
                        'msg' => '该用户不存在',
                        );
                        echo json_encode($return);
                        return ;
                      }
                   }break;

            case '3':{
                      $sql="select * from super_admin where sup_email='".$user_name."'";
                      $result=$conn->query($sql);
                      $num=$result->num_rows;
                      if($num){
                         $row=$result->fetch_object();
                         $name=$row->sup_email;
                         $pass=$row->sup_passwd;  
                         $_SESSION['user_id']=$row->sup_id;
                         $_SESSION['user_name']=$row->sup_nickname; 
                      }
                      else{
                        $return = array(
                        'code' => 0,
                        'msg' => '该用户不存在',
                        );
                        echo json_encode($return);
                        return ;
                      }
                   }break;
               }
            
            if($user_name==$name&&$user_pass==$pass){
           //     if($user_code==$_SESSION['koo']){
                    $flag=1;                               
              //}                      
            }
            $conn->close();
            if($flag==1){

                  if($pass_status == 1){
                        $return = array(
                         'code' => -2,
                         'msg' => '该用户正在审核中',
                         ); 
                         echo json_encode($return);
                         return ;
                    }
    
                 $return = array(
                 'code' => 1,
                 'msg' => '登录成功',
                 ); 
                 echo json_encode($return);
                 return ;  
            }
                //header("location:../client2.0/index.html");
            else{
                $return = array(
                          'code' => -1,
                          'msg' => '登录失败',
                          );
                          echo json_encode($return);
                          return ;    
            }

            
?>

