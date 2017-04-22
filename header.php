<header id="header">
    <div class="center">
        <h1 class="logo">
            知道网
        </h1>
        <nav class="link">
            <ul>
                <li><a href="index.php">首页</a></li>
                <li><a href="users.php">用户<span class="sm-hidden">列表</span></a></li>
                <li><a href="search.php">搜索</a></li>
                <?php if(isset($_COOKIE['id'])):?>
                    <li><a href="member.php">个人<span class="sm-hidden">中心</span></a></li>
                    <li><a href="logout.php">退出</a></li>
                <?php else:?>
                    <li><a href="login.php">登录</a></li>
                    <li><a href="register.php">注册</a></li>
                <?php endif;?>
            </ul>
        </nav>
    </div>
</header>