<?php
header("Content-Type: text/html; charset=utf-8"); 
include("RubbishClassify.php"); 	
$image = file_get_contents('2.jpg');
$img = base64_encode($image);
$headers = array('Accept' => 'application/json');
$options = array('key' => "2a977b7b5950a2e0e047c1b8be95a780",'img'=>$img);
$request=new RubbishClassify();

//$request = Requests::get('http://api.tianapi.com/txapi/imglajifenlei/', $headers, $options);
$request=$request->request($request->'http://api.tianapi.com/txapi/imglajifenlei/', $options, $headers);
var_dump($request);



	
//$data = file_get_contents ("http://api.tianapi.com/txapi/imglajifenlei/?key=2a977b7b5950a2e0e047c1b8be95a780&img=$img" );//API接口
//    $json = json_decode($data,true);//将json解析成数组
//    if($json['code'] == 200){ //判断状态码
//		  print_r($json); //打印数组
//	}else{	
//		echo "返回错误，状态消息：".$json['msg'];
//	  }
?>