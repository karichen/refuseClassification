<?php
//连接数据库javascript:;
include("dataBase.php");
//设置时间
$kind = '香蕉';
date_default_timezone_set("PRC");
$sql_1 = "select count(*) count from hotdata where kind ='{$kind}'";
$sql_2 = "update hotdata set hot = hot+1 where  kind = '{$kind}'";
$sql_3 = "insert into hotdata VALUES(null,'{$kind}',1)";
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
    if($res){
        echo "存在11cg";
    }else{
        echo "存在11sb";
    }
}else{
    //不存在插入数据
    $res = mysqli_query($con,$sql_3);
    if($res){
        echo "不存在插入cg";
    }else{
        echo "不存在插入sb";
    }
}





