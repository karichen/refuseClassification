<?php
header("Content-Type: text/html; charset=utf-8");
include("AipImageClassify.php");
include("dataBase.php");
date_default_timezone_set("Asia/Shanghai");
class Resin{
    public $name;
    public $description;
}
if(isset($_FILES['imgfile'])){
$uplad_tmp_name=$_FILES['imgfile']['tmp_name'];
$uplad_name    =$_FILES['imgfile']['name'];
$image_url="";
//上传文件类型列表
$uptypes=array(
    'image/jpg',
    'image/jpeg',
    'image/png',
    'image/pjpeg',
    'image/gif',
    'image/bmp',
    'image/x-png'
);
//图片目录
$img_dir="img/";
$uploaded=0;
$unuploaded=0;
//上传文件路径
$img_url="pet";
$date = rand(1,1000000);
//如果当前图片不为空
if(!empty($uplad_name))
{
	$uptype = explode(".",$uplad_name);
    $newname =$date. "-0".".".$uptype[1];
    //echo($newname);
	$uplad_name= $newname;
	
     //如果上传的文件没有在服务器上存在
	 if(!file_exists($img_dir.$uplad_name))
	 {   //把图片文件从临时文件夹中转移到我们指定上传的目录中
        $file=$img_dir.$uplad_name;
        move_uploaded_file($uplad_tmp_name,$file);
        chmod($file,0644);
        $img_url1=$img_url.$newname;
        $uploaded++;
		 $client = new AipImageClassify(APP_ID, API_KEY, SECRET_KEY);
         $image =file_get_contents($file) ;
		 $options = array();
		 $options["top_num"] = 3;
		 $options["baike_num"] = 5;
			$res=$client->advancedGeneral($image, $options);
			$str=$res ['result']['0']["root"];
			$resin=explode("-",	$str)[1];
	 // 	var_dump($resin);
		 $key="2a977b7b5950a2e0e047c1b8be95a780";	
		   $data = file_get_contents ("http://api.tianapi.com/txapi/lajifenlei/?key=$key&word=$resin" );//API接口
		   $json = json_decode($data,true);//将json解析成数组
		   if($json['code'] == 200){ //判断状态码
		   $rub=$json["newslist"][0]["explain"];  
		   echo json_encode($rub,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
			  // print_r($rub); //打印数组
			 mysqli_close($con);
		 }else{	
			echo json_encode(array('status'=>-1,'message'=>'fail'));
			 mysqli_close($con);
		   }
		}
	}
}else if(isset($_GET['wordDescription'])){
	      $resin=$_GET['wordDescription'];
	      $key="2a977b7b5950a2e0e047c1b8be95a780";
		  $data = file_get_contents ("http://api.tianapi.com/txapi/lajifenlei/?key=$key&word=$resin" );//API接口
	      $json = json_decode($data,true);//将json解析成数组
		  if($json['code'] == 200){ //判断状态码
		  $rub=$json["newslist"][0]["explain"];
              // print_r($rub); //打印数组

              //当结果成功返回就可以对热门搜索进行操作
           

              date_default_timezone_set("PRC");
              $sql_1 = "select count(*) count from hotdata where kind ='{$resin}'";
              $sql_2 = "update hotdata set hot = hot+1 where  kind = '{$resin}'";
              $sql_3 = "insert into hotdata VALUES(null,'{$resin}',1)";
//是否存在
              $exist = mysqli_query($con,$sql_1);
              $rows = array();
              while ($row = mysqli_fetch_assoc($exist)){
                  $rows[] = $row;
              }
              $isexist = $rows[0]['count'];
//是否存在
              if($isexist){
                  //存在hot+1
                  $res = mysqli_query($con,$sql_2);
//                  if($res){
//                      echo "存在11cg";
//                  }else{
//                      echo "存在11sb";
//                  }
              }else{
                  //不存在插入数据
                  $res = mysqli_query($con,$sql_3);
//                  if($res){
//                      echo "不存在插入cg";
//                  }else{
//                      echo "不存在插入sb";
//                  }
              }
		  echo json_encode($rub,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
		   mysqli_close($con);

}
}
?>
