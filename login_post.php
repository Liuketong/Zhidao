<?php
//判断是否是register.php提交过来的
if(isset($_POST['send'])){
    //接受提交的数据

    //引入工具函数
    require 'include/tool.php';

    //引入配置函数
    require 'include/config.php';

    //引入数据库连接
    require 'include/mysql.php';

    //帐号：电子邮件或手机，使用正则
    $accounts       =      trim($_POST['accounts']);

    //密码：不得小于六位
    $password       =      sha1(SALT.$_POST['password']);

    $loginSql = "SELECT id FROM zhidao_users WHERE accounts = '$accounts' AND password = '$password' LIMIT 1";

    $result = mysqli_query($db,$loginSql);

    if($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        if(isset($_POST['state'])){
            //记住登录状态
            setcookie('id',$row['id'],time() + 60 * 60 * 24 * 7);
//            setcookie('nickname',$row['nickname'],time() + 60 * 60 * 24 * 7);
        }else{
            //临时记住登录状态
            setcookie('id',$row['id']);
//            setcookie('nickname',$rows['nickname']);
        }
        location('登录成功！','./');
    }else{
        alert('账号或密码不正确！') ;
    }

}else{
    exit('非法操作！');
}