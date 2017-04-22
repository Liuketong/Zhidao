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
    <title>注册—知道网</title>
    <link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

<?php require 'header.php'?>

<div id="container">
    <form class="form" action="register_post.php" method="post">
        <label for="">
            <input type="text" class="text" name="accounts" placeholder="电子邮件/手机（必填）">
        </label>
        <label for="">
            <input type="password" class="text" name="password" placeholder="密码(必填，不得小于六位)">
        </label>
        <label for="">
            <input type="password" class="text" name="notpassword" placeholder="密码确认（必填，必须与密码相同）">
        </label>
        <label for="">
            <input type="text" class="text" name="nickname" placeholder="呢称（必填，建议中文，不得重复）">
        </label>
        <label for="">
            <select name="face" class="select">
                <option> - 请选择一个头像 - （可选）</option>
                <option value="1">头像1</option>
                <option value="2">头像2</option>
                <option value="3">头像3</option>
                <option value="4">头像4</option>
                <option value="5">头像5</option>
                <option value="6">头像6</option>
                <option value="7">头像7</option>
                <option value="8">头像8</option>
                <option value="9">头像9</option>
                <option value="10">头像10</option>
            </select>
        </label>
        <label for="">
            <button type="submit" class="submit" name="send">注册新用户</button>
        </label>
    </form>
</div>

<?php require 'footer.php'?>

</body>
</html>