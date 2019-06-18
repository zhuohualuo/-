
 <?php
require_once "../config.php";
require_once "../function.php";
checkLogin();
?> 
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Dashboard &laquo; Admin</title>
    <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../static/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../static/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="../static/assets/css/admin.css">
    <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
</head>

<body>
    <script>
        NProgress.start()
    </script>

    <div class="main">
        <!-- <nav class="navbar">
            <button class="btn btn-default navbar-btn fa fa-bars"></button>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="profile.html"><i class="fa fa-user"></i>个人中心</a></li>
                <li><a href="login.html"><i class="fa fa-sign-out"></i>退出</a></li>
            </ul>
        </nav> -->
        <?php include_once "./public/_navbar.php" ?>
        <div class="container-fluid">
            <div class="jumbotron text-center">
                <h1>One Belt, One Road</h1>
                <p>Thoughts, stories and ideas.</p>
                <p><a class="btn btn-primary btn-lg" href="post-add.html" role="button">写文章</a></p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">站点内容统计：</h3>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>10</strong>篇文章（<strong>2</strong>篇草稿）</li>
                            <li class="list-group-item"><strong>6</strong>个分类</li>
                            <li class="list-group-item"><strong>5</strong>条评论（<strong>1</strong>条待审核）</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>

    <!-- <div class="aside">
        <div class="profile">
            <img class="avatar" src="../static/uploads/avatar.jpg">
            <h3 class="name">布头儿</h3>
        </div>
        <ul class="nav">
            <li class="active">
                <a href="index.html"><i class="fa fa-dashboard"></i>仪表盘</a>
            </li>
            <li>
                <a href="#menu-posts" class="collapsed" data-toggle="collapse">
                    <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
                </a>
                <ul id="menu-posts" class="collapse">
                    <li><a href="posts.html">所有文章</a></li>
                    <li><a href="post-add.html">写文章</a></li>
                    <li><a href="categories.html">分类目录</a></li>
                </ul>
            </li>
            <li>
                <a href="comments.html"><i class="fa fa-comments"></i>评论</a>
            </li>
            <li>
                <a href="users.html"><i class="fa fa-users"></i>用户</a>
            </li>
            <li>
                <a href="#menu-settings" class="collapsed" data-toggle="collapse">
                    <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
                </a>
                <ul id="menu-settings" class="collapse">
                    <li><a href="nav-menus.html">导航菜单</a></li>
                    <li><a href="slides.html">图片轮播</a></li>
                    <li><a href="settings.html">网站设置</a></li>
                </ul>
            </li>
        </ul>
    </div> -->
    <?php echo $current_page = "index"; ?>
    <?php include_once "./public/_aside.php"?>

    <script src="../static/assets/vendors/jquery/jquery.js"></script>
    <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script>
        NProgress.done()
    </script>
</body>

</html>