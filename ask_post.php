<?php
//判断是否是ask.php提交过来的
if(isset($_POST['send'])) {
    //接受提交的数据

    //引入工具函数
    require 'include/tool.php';

    //标题，不得为空
    $title = trim($_POST['title']);

    if(empty($title)){
        alert('标题不得为空！');
    }

    //问题详情，不得为空
    $details = trim($_POST['details']);

    if(empty($details)){
        alert('问题详情不得为空！');
    }

    //引入数据库连接
    require 'include/mysql.php';

    //SQL语句
    $addSql = "INSERT INTO zhidao_ask(title,details,users_id,create_time)
                            VALUE('$title','$details', '{$_COOKIE['id']} ',NOW())";

    //执行SQL，成功后并跳转
    if(mysqli_query($db,$addSql)){
        $updateSql = "UPDATE zhidao_users SET ask_count=ask_count+1 WHERE id='{$_COOKIE['id']}'";

        mysqli_query($db,$updateSql);

        location('问题发表成功！','./');
    }
}else{
    exit('非法操作！');
}