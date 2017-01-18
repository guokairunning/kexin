<?php 

//传入存储路径
//返回图片存储地址

class pictureApi {

    private $url;   //图片存储路径

    public function __construct($parmUrl) {
        $this->url = $parmUrl;
    }

    /**
     * 图片上传接口
     */
    public function upload() {
        $config['upload_path'] = $this->url;
        foreach ($_FILES as $key => $value) {
            if($value['size'] == 0){
                $return = array(
                       'code' => -1,
                       'msg' => '文件不能为空',
                );
                return $return;
            }

            $type = $value['type'];
            switch ($type) {
                case 'image/jpeg':
                    $config['suffix'] = '.jpg';
                    break;
                case 'image/x-png':
                    $config['suffix'] = '.png';
                    break;
                case 'image/gif':
                    $config['suffix'] = '.gif';
                    break;
                case 'image/bmp':
                    $config['suffix'] = '.bmp';
                    break;
                default:
                    $return = array(
                       'code' => -2,
                       'msg' => '仅支持上传jpg,png,gif,bmp格式',
                    );
                    return $return;
            }

            if($value['size'] > 2097152){
                $return = array(
                    'code' => -3,
                    'msg' => '图片过大，请更换图片',
                );
                return $return;
            }
            
            $tmp_name = $value['tmp_name'];
        }

        $config['name'] = time() . mt_rand() . $config['suffix'];

        if(move_uploaded_file($tmp_name, $config['upload_path'] . $config['name'])) {
            $return = array(
                'code' => 0,
                'filename' => $this->url.$config['name'],
            );
            $return['filename'][0] = 'r';
            $return['filename'] = '../serve'.$return['filename'];

        } else {
            $return = array(
                'code' => -4,
                'msg' => '图片上传失败，请重试',
            );
        }
        
        return $return;

    }
}

class messageApi{

    public  $mess_belong_id;
    public  $mess_content;
    private $mess_send_nickname;
    private $mess_haveread = 0;

    public function __construct($mess_belong_id, $mess_content) {
        $this->mess_belong_id = $mess_belong_id;
        $this->mess_content = $mess_content;
        $this->mess_send_nickname = $_SESSION['user_name'];
    }

    public function sendMessage(){
        @$con = mysql_connect("localhost","root","199698");
        if (!$con){
          die('Could not connect: ' . mysql_error());
        }

        mysql_select_db("kx", $con);
        mysql_query("SET NAMES utf8"); 
        
        //insert message
        $sql= "INSERT INTO message(mess_belong_id,mess_content,mess_send_nickname,mess_haveread) 
         VALUES ($this->mess_belong_id,'$this->mess_content','$this->mess_send_nickname',$this->mess_haveread)";
        //echo $sql;
        mysql_query($sql,$con);
          
    }
}








 
?>