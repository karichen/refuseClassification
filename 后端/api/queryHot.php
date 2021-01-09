<?php
//连接数据库
include("dataBase.php");
//设置时间
date_default_timezone_set("PRC");

    $star = $_POST['star'];
    $length = $_POST['length'];
    $sql = 'select * from hotdata order by hot desc limit '.$star.','.$length;
//发送sql指令
        $res = mysqli_query($con,$sql);
//把拿到的资源集转化成数组
        $rows = array();
        while ($row = mysqli_fetch_assoc($res)){
            $rows[] = $row;
        }
        echo json_encode($rows);
         mysqli_close($con);


