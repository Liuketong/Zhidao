<?php
//引入数据库连接
    require 'include/mysql.php';

//每页的条数
$pageSize = 4;

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
$totalSql = "SELECT COUNT(*) FROM zhidao_users";

//得到总记录数
$total = mysqli_fetch_array(mysqli_query($db,$totalSql))[0];
$total1 = mysqli_fetch_array(mysqli_query($db,$totalSql));
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

$limit = "$num,$pageSize";

//获取用户列表的SQL
$usersSql = "SELECT nickname,face,re_count,ask_count FROM zhidao_users ORDER BY create_time DESC LIMIT $limit";

//获取结果集
$result = mysqli_query($db,$usersSql);

?>

<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>用户列表—知道网</title>
    <link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/users.css">
</head>
<body>

<?php require 'header.php'?>

<div id="container">
    <div class="figure">
        <?php while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)):?>
        <figure>
            <img src="img/face/<?=$rows['face']?>.png" alt="<?=$rows['nickname']?>">
            <figcaption>
                <div class="nickname"><?=$rows['nickname']?></div>
                <div class="info">提问：<?=$rows['ask_count']?>|回答：<?=$rows['re_count']?></div>
            </figcaption>
        </figure>
        <?php endwhile;?>
    </div>
    <div class="page">
        <ul>
            <?php
            //上一页
            if($page == 1){
                echo '<li class="first"><a href="javascript:void(0)">&lt;</a></li>';
            }else{
                echo '<li class="first"><a href="users.php?page='.($page-1).'">&lt;</a></li>';
            }

            //循环分页页码
            for($i = 1;$i <= $pageAbsolute;$i++){
                if($page == $i){
                    echo '<li><a href="javascript:void(0)" class="active">'.$i.'</a></li>';
                }else{
                    echo '<li><a href="users.php?page='.$i.'">'.$i.'</a></li>';
                }
            }

            //下一页
            if($page == $pageAbsolute){
                echo '<li class="last"><a href="javascript:void(0)">&gt;</a></li>';
            }else{
                echo '<li class="last"><a href="users.php?page='.($page+1).'">&gt;</a></li>';
            }
            ?>
        </ul>
    </div>
</div>

<?php require 'footer.php'?>

</body>
</html>