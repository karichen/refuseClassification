<?php
	header("content-type:text/html;charset=utf-8");  
     include("AipImageClassify.php");

 
     // 调用物体识别

     $client = new AipImageClassify(APP_ID, API_KEY, SECRET_KEY);
     $image = file_get_contents('1.jpg');
    
	// 如果有可选参数
	
	$options = array();
	$options["top_num"] = 3;
	$options["baike_num"] = 5;

	// 带参数调用动物识别
     $res=$client->animalDetect($image, $options);
     $resin['name']=$res ['result']['0']["name"];
     $resin['description']=$res['result']['0']["baike_info"] ["description"];
     var_dump($resin);
?>