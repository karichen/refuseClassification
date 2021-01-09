<?php
header("Content-Type: text/html; charset=utf-8");
include("AipImageClassify.php");
$client = new AipImageClassify(APP_ID, API_KEY, SECRET_KEY);
$image =file_get_contents('img/2.jpg') ;
$options = array();
$options["top_num"] = 3;
$options["baike_num"] = 5;
   $res=$client->advancedGeneral($image, $options);
   $str=$res ['result']['0']["root"];
   $resin=explode("-",	$str)[1];
 	//var_dump($resin);
 $key="2a977b7b5950a2e0e047c1b8be95a780";	
   $data = file_get_contents ("http://api.tianapi.com/txapi/lajifenlei/?key=$key&word='餐巾纸'" );//API接口
   $json = json_decode($data,true);//将json解析成数组
   if($json['code'] == 200){ //判断状态码
  $rub=$json["newslist"][0]["explain"];  
      var_dump($rub); //打印数组
      mysqli_close($con);
    }else {
        print_r("啊哈");
       mysqli_close($con);
    }
?>