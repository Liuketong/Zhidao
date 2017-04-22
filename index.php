<?php
//引入数据库连接
require 'include/mysql.php';

//每页的条数
$pageSize = 10;

//当前页码
$page = 1;

//总页码默认初始为1
$pageAbsolute = 1;

//先判断page是否存在
if(isset($_GET['page'])){
    //将得到的页码赋值给变量
    $page = $_GET['page'];

    //如果页面值为空或小于零或不是数字，则默认为1
    if(empty($page) || $page < 0 || !is_numeric($page)){
        $page = 1;
    }else{
        //如果是小数的话，取整
        $page = intval($page);
    }
}

//总记录数的SQL
$totalSql = "SELECT COUNT(*) FROM zhidao_ask WHERE re_id=0 ";

//得到总记录数
$total = mysqli_fetch_array(mysqli_query($db,$totalSql))[0];

//得到总页码
if($total != 0){
    $pageAbsolute = ceil($total/$pageSize);
}

//超过页码判断
if($page > $pageAbsolute){
    $page = $pageAbsolute;
}

//计算当前页码从第几条开始
$num = ($page - 1) * $pageSize;

//组合成LIMIT
$limit = "$num,$pageSize";

//获取问题列表的SQL
$askSql = "SELECT id,title,reading,comment,users_id,create_time FROM zhidao_ask WHERE re_id=0 ORDER BY create_time DESC LIMIT $limit";

//获取结果集
$result = mysqli_query($db,$askSql);

?>
<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>知道网</title>
    <link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<?php require 'header.php'?>

<div id="container">
    <div class="list">
        <div class="button">
            <a href="ask.php" class="ask">提问</a>
        </div>

        <?php
        //循环出问题列表
        while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)):

        //获取用户信息的SQL
        $usersSql = "SELECT face,nickname FROM zhidao_users WHERE id = '{$rows['users_id']}' LIMIT 1";

        //得到用户数组
        $usersArray = mysqli_fetch_array(mysqli_query($db,$usersSql),MYSQLI_ASSOC);

        ?>
        <dl class="question">
            <dt class="question_img">
                <img src="img/face/<?=$usersArray['face']?>.png" alt="<?=$usersArray['nickname']?>" class="question_face">
            </dt>
            <dd class="question_title">
                <a href="details.php?id=<?=$rows['id']?>" target="_blank"><?=$rows['title']?></a>
            </dd>
            <dd class="question_info"><em>阅:<?=$rows['reading']?> | 评:<?=$rows['comment']?></em><?=$usersArray['nickname']?> | <?=$rows['create_time']?></dd>
        </dl>
        <?php endwhile;?>



        <div class="page">
            <ul>
                <?php
                //上一页
                if($page == 1){
                    echo '<li class="first"><a href="javascript:void(0)">&lt;</a></li>';
                }else{
                    echo '<li class="first"><a href="index.php?page='.($page-1).'">&lt;</a></li>';
                }

                //循环分页页码
                for($i = 1;$i <= $pageAbsolute;$i++){
                    if($page == $i){
                        echo '<li><a href="javascript:void(0)" class="active">'.$i.'</a></li>';
                    }else{
                        echo '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
                    }
                }

                //下一页
                if($page == $pageAbsolute){
                    echo '<li class="last"><a href="javascript:void(0)">&gt;</a></li>';
                }else{
                    echo '<li class="last"><a href="index.php?page='.($page+1).'">&gt;</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <aside class="sidebar">
        <h2><em>总量：120个</em>问答总汇</h2>
        <div class="adver">
            <img src="img/adver.png" alt="广告图">
        </div>
    </aside>
</div>

<?php require 'footer.php'?>

</body>
</html>