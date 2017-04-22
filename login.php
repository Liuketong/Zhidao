<?php
    //引入工具函数
    require 'include/tool.php';

    if(isset($_COOKIE['id'])){
        alert('您已登录！');
    }
?>
<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>登录—知道网</title>
    <link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<?php require 'header.php'?>

<div id="container">
    <form class="form" action="login_post.php" method="post">
        <label for="">
            <input type="text" class="text" name="accounts" placeholder="登陆账号">
        </label>
        <label for="">
            <input type="password" class="text" name="password" placeholder="登陆密码">
        </label>
        <label>
            <input type="checkbox" class="state" name="state"> 记住登录状态
        </label>
        <label>
            <button type="submit" class="submit" name="send">登录</button>
        </label>
    </form>
</div>

<?php require 'footer.php'?>

</body>
</html>