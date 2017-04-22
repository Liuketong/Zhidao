<?php
//判断是否是member.php提交过来的
if(isset($_POST['send'])){

    //获取头像
    $face = $_POST['face'];

    //获取密码
    $password = $_POST['password'];

    //获取密码确认
    $notpassword = $_POST['notpassword'];

    //引入工具函数
    require 'include/tool.php';

    //引入数据库连接
    require 'include/mysql.php';

    //判断表单是否有修改数据
    if(empty($face.$password.$notpassword)){
        alert('表单尚未修改任何数据');
    }

    //限制头像组合的SQL
    $groupSql = empty($face) ? "" : "face='$face'";

    //限制密码组合的SQL
    if(!empty($password.$notpassword)){

        //密码小于六位，不予通过
        if(strlen($password) < 6){
            alert('密码不得小于六位！');
        }

        //密码与密码确认不符合
        if($password != $notpassword){
            alert('密码确认和密码不符合！');
        }

        //引入常量库
        require 'include/config.php';

        //将密码加密
        $password = sha1(SALT.$password);

        //组合SQL
        $groupSql = empty($groupSql) ? "password='$password'" : $groupSql.",password='$password'";
    }

    //修改资料SQL
    $updateSql = "UPDATE zhidao_users SET $groupSql WHERE id='{$_COOKIE['id']}'";

    //执行修改
    mysqli_query($db,$updateSql);

    //判断影响行数
    if(mysqli_affected_rows($db) > 0){
        location('修改资料成功！','member.php');
    }else{
        alert('资料未被修改！');
    }


}else{
    exit('非法操作！');
}