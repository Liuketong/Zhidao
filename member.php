<?php
//引入工具函数
require 'include/tool.php';

if(!isset($_COOKIE['id'])){
    location('尚未登录','login.php');
}

//引入数据库连接
require 'include/mysql.php';

//获取用户资料SQL
$memberSql = "SELECT accounts,nickname,face FROM zhidao_users WHERE id='{$_COOKIE['id']}'";

//获取用户数据
$rows = mysqli_fetch_array(mysqli_query($db,$memberSql),MYSQLI_ASSOC);

?>

<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>个人中心—知道网</title>
    <link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/member.css">
</head>
<body>

<?php require 'header.php'?>

<div id="container">
    <form class="form" action="member_post.php" method="post">
        <label for="">
            <img src="img/face/<?=$rows['face']?>" alt="<?=$rows['nickname']?>">
        </label>
        <label for="">
            <input type="text" class="text" value="账号:<?=$rows['accounts']?>" disabled>
        </label>
        <label for="">
            <input type="text" class="text" value="呢称:<?=$rows['nickname']?>" disabled>
        </label>
        <label for="">
            <select name="face" class="select">
                <option value=""> - 请修改一个头像 - </option>
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
            <input type="password" class="text" name="password" placeholder="密码，不修改则留空">
        </label>
        <label for="">
            <input type="password" class="text" name="notpassword" placeholder="密码确认，必须与密码相同">
        </label>
        <label for="">
            <button type="submit" class="submit" name="send">修改资料</button>
        </label>
    </form>
</div>

<?php require 'footer.php'?>

</body>
</html>