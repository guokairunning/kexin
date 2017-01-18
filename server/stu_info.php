<?php
header("Content-Type: text/html;charset=utf-8");
    session_start();
    $user_id=$_SESSION['user_id'];


    
    $name=$_POST['name'];
    $num=$_POST['num'];
    $school=$_POST['school'];
    $label=$_POST['label'];

    // echo  $name."<br/>";
    // echo  $num."<br/>";
    // echo  $school."<br/>";
    // echo  $label."<br/>";



    $conn=new mysqli("localhost","root","199698","kx");
    $query = "set names utf8";
    $result = $conn->query($query);
    $sql="UPDATE student_info SET stu_num=$num,stu_name='".$name."',stu_school='".$school."',stu_label='".$label."' WHERE stu_id=$user_id";
    echo $sql;
     $conn->query($sql);  
       echo "<script>alert('成功');history.go(-1)</script>";
       header("location:../client2.0/person_info.php");   
    
 ?>