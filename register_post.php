<?php
//判断是否是register.php提交过来的
if(isset($_POST['send'])){
    //接受提交的数据

    //引入工具函数
    require 'include/tool.php';

    //帐号：电子邮件或手机，使用正则
    $accounts       =      trim($_POST['accounts']);

    if (!preg_match('/^([\w\.-]+)@([a-z0-9-]+)\.([a-z]{2,4})| 1[34578]{1}\d{9}$/i', $accounts)) {
        alert('手机或电子邮件格式不合法！');
    }

    //密码：不得小于六位
    $password       =      $_POST['password'];

    if(strlen($password) < 6){
        alert('密码不得小于六位！');
    }

    //密码确认：必须和密码相同
    $notpassword    =      $_POST['notpassword'];

    if($password != $notpassword){
        alert('密码确认和密码不符合！');
    }

    //昵称：必须填写，不得重复
    $nickname       =     trim($_POST['nickname']);

    if(strlen($nickname) == 0){
        alert('呢称不得为空！');
    }

    $face           =      $_POST['face'];

    //引入数据库连接
    require 'include/mysql.php';

    //验证账号是否重复
    $accountsSql = "SELECT id FROM zhidao_users WHERE accounts = '$accounts' LIMIT 1";

    $result = mysqli_query($db,$accountsSql);

    if(mysqli_fetch_array($result)){
        alert('手机或电子邮件已占用！');
    }

    //验证呢称是否重复
    $nicknameSql = "SELECT id FROM zhidao_users WHERE nickname = '$nickname' LIMIT 1";

    $result = mysqli_query($db,$nicknameSql);

    if(mysqli_fetch_array($result)){
        alert('呢称已占用！');
    }

    //引入常量库
    require 'include/config.php';

    //将密码加密
    $password = sha1(SALT.$password);

    //SQL语句
    $addSql = "INSERT INTO zhidao_users(accounts,password,nickname,face,create_time)
                            VALUE('$accounts','$password', '$nickname ','$face',NOW())";

    //执行SQL,成功后并跳转
    if(mysqli_query($db,$addSql)){
        location('注册用户成功！','login.php');
    }
}else{
    exit('非法操作！');
}

