<?php
//引入工具函数
require 'include/tool.php';

//判断是否有id传递过来
if(!isset($_GET['id']) || empty($_GET['id'])){
    alert('非法操作！');
}

//引入数据库函数
require 'include/mysql.php';

//验证问题SQL
$askSql = "SELECT title,details,users_id,reading,comment,create_time FROM zhidao_ask WHERE id='{$_GET['id']}'";

$askResult = mysqli_query($db,$askSql);

if($askRows = mysqli_fetch_array($askResult,MYSQLI_ASSOC)){
    //查找到数据，就累积+1

    //累加SQL
    $updateSql = "UPDATE zhidao_ask SET reading=reading+1 WHERE id='{$_GET['id']}'";

    //执行累加
    mysqli_query($db,$updateSql);

}else{
    //没数据，就返回报错
    alert('不存在的问题');
}

//获取用户数据
//获取用户信息的SQL
$userSql = "SELECT nickname,face FROM zhidao_users WHERE id='{$askRows['users_id']}'";

//获取数据数组
$usersArray = mysqli_fetch_array(mysqli_query($db,$userSql),MYSQLI_ASSOC);

//获取热门问答
$hotSql = "SELECT * FROM zhidao_ask WHERE re_id=0 ORDER BY reading DESC LIMIT 10";

$hotResult = mysqli_query($db,$hotSql);

//获取回复列表
$reSql = "SELECT id,details,users_id,create_time FROM zhidao_ask WHERE re_id='{$_GET['id']}'";

$reResult = mysqli_query($db,$reSql);

//获取回复条数
$reTotal = mysqli_fetch_array(mysqli_query($db,"SELECT COUNT(*) FROM zhidao_ask WHERE re_id='{$_GET['id']}'"))[0];

?>
<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?=$askRows['title']?>—知道网</title>
    <link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/details.css">
</head>
<body>

<?php require 'header.php'?>

<div id="container">
    <div class="details">
        <dl class="question">
            <dt class="question_img">
                <img src="img/face/<?=$usersArray['face']?>.png" alt="<?=$usersArray['nickname']?>" class="question_face">
            </dt>
            <dd class="question_title">
                <h1><?=$askRows['title']?></h1>
            </dd>
            <dd class="question_info"><em>阅:<?=$askRows['reading']?> | 评:<?=$askRows['comment']?></em><?=$usersArray['nickname']?> | 发表于<?=$askRows['create_time']?></dd>
        </dl>

        <div class="info">
            <em>阅:0 | 评:0</em><?=$usersArray['nickname']?> | <?=$askRows['create_time']?>
        </div>

        <div class="content">
            <?=nl2br($askRows['details'])?>
        </div>

        <div class="re">
            <a href="#re" class="re_button">回复</a>
        </div>

        <!--回复区-->
        <div class="re_total">
            <strong><?=$reTotal?></strong>条回复
        </div>

        <?php
            //循环的回复答案
            while($reRows = mysqli_fetch_array($reResult,MYSQLI_ASSOC)):

            //获取用户信息的SQL
            $reUserSql = "SELECT face,nickname FROM zhidao_users WHERE id='{$reRows['users_id']}' LIMIT 1";

            //得到用户数组
            $reUserArray = mysqli_fetch_array(mysqli_query($db,$reUserSql),MYSQLI_ASSOC);

         ?>
        <dl class="answer">
            <dt class="answer_img">
                <img src="img/face/<?=$reUserArray['face']?>.png" alt="<?=$reUserArray['nickname']?>" class="answer_face">
            </dt>
            <dd class="answer_info"><?=$reUserArray['nickname']?><span class="md-hidden">| <?=$reRows['create_time']?></span></dd>
            <dd class="answer_content">
                <?=nl2br($reRows['details'])?>
            </dd>
        </dl>
        <?php endwhile;?>

        <!--回复表单-->
        <?php if(isset($_COOKIE['id'])):?>
        <form class="form" action="reask_post.php" method="post">
            <a name="re"></a>
            <input type="hidden" name="re_id" value="<?=$_GET['id']?>">
            <input type="hidden" name="re_title" value="RE:<?=$askRows['title']?>">
            <label>
                <textarea name="re_details" class="textarea"></textarea>
            </label>
            <label>
                <button type="submit" class="submit" name="send">发表回复</button>
            </label>
        </form>
        <?php endif;?>

    </div>
    <aside class="sidebar">
        <h2>热门问题</h2>
        <ul class="hot">
            <?php while($hotRows = mysqli_fetch_array($hotResult,MYSQLI_ASSOC)):?>
            <li><a href="details.php?id=<?=$hotRows['id']?>" target="_blank"><?=$hotRows['title']?></a></li>
            <?php endwhile;?>
        </ul>
    </aside>
</div>

<div></div>

<?php require 'footer.php'?>

</body>
</html>