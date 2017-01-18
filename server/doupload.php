<?php
if ((($_FILES["file1"]["type"] == "image/gif")
|| ($_FILES["file1"]["type"] == "image/jpeg")
|| ($_FILES["file1"]["type"] == "image/bmp")
|| ($_FILES["file1"]["type"] == "image/pjpeg"))
&& ($_FILES["file1"]["size"] < 100000)){//100KB

    $extend = explode(".",$_FILES["file1"]["name"]);

    $key = count($extend)-1;

    $ext = ".".$extend[$key];

    $newfile = time().$ext;

 

    if(!file_exists('upload')){mkdir('upload');}

    move_uploaded_file($_FILES["file1"]["tmp_name"],"upload/" . $newfile);

    @unlink($_FILES['file1']);

    echo $newfile;

}else {

    echo 'error';

}

?>