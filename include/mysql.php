<?php
//连接数据库，项目上线后要在函数前加@，屏蔽错误，生产阶段则不需要
$db = mysqli_connect('localhost','root','','zhidao');

//连接错误提示，并退出执行
if(mysqli_connect_errno() > 0){
    exit('数据库连接错误'.mysqli_connect_errno());
}

//设置一下访问字符集
mysqli_set_charset($db,'UTF8');