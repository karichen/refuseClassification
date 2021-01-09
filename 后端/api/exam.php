<?php
header("Content-Type: text/html; charset=utf-8");
include("dataBase.php");
date_default_timezone_set("Asia/Shanghai");
   $forum_data="exam";
    //$sql=$sql="SELECT * FROM  ( SELECT * FROM $forum_data  $where  ORDER BY `id` DESC ) AS T WHERE id >= ((SELECT MAX(id) FROM $forum_data)-(SELECT MIN(id) FROM $forum_data)) * RAND() + (SELECT MIN(id) FROM $forum_data) LIMIT 10";
    $sql="SELECT * FROM exam WHERE id >= ( SELECT floor(RAND() * (SELECT MAX(id) FROM exam))) ORDER BY id LIMIT 10";
   //$sql ="select * from exam  ";
//发送sql指令
        $res = mysqli_query($con,$sql);
//把拿到的资源集转化成数组
        $rows = array();
        while ($row = mysqli_fetch_assoc($res)){
            $rows[] = $row;
        }
        
        echo json_encode($rows,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
         mysqli_close($con);

?>