
<?php
   //连接数据库
              $con = mysqli_connect('localhost','root','root');

//设置字符集
              header('content-type:text/html;charset=utf-8');

//选择数据库
              mysqli_query($con,"use rubbish");

//设置编码
              mysqli_query($con,"set names utf8");

//设置时间

?>