<?php
//引入工具函数
require 'include/tool.php';

if(!isset($_COOKIE['id'])){
    location('尚未登录！','login.php');
}
?>
<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>发表提问—知道网</title>
    <link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/ask.css">
</head>
<body>

<?php require 'header.php'?>

<div id="container">
    <form class="form" action="ask_post.php" method="post">
        <label for="">
            <input type="text" class="text" name="title" placeholder="请输入你要提的问题">
        </label>
        <label for="">
            <textarea name="details" class="textarea"></textarea>
        </label>
        <label for="">
            <button type="submit" class="submit" name="send">发起提问</button>
        </label>
    </form>
</div>

<?php require 'footer.php'?>

</body>
</html>