<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Comments &laquo; Admin</title>
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
        <?php include_once "public/_navbar.php"; ?>
        <div class="container-fluid">
            <div class="page-title">
                <h1>所有评论</h1>
            </div>
            <!-- 有错误信息时展示 -->
            <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
            <div class="page-action">
                <!-- show when multiple checked -->
                <div class="btn-batch" style="display: none">
                    <button class="btn btn-info btn-sm">批量批准</button>
                    <button class="btn btn-warning btn-sm">批量拒绝</button>
                    <button class="btn btn-danger btn-sm">批量删除</button>
                </div>
                <ul class="pagination pagination-sm pull-right">
                    <!-- <li><a href="#">上一页</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">下一页</a></li> -->
                </ul>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="40"><input type="checkbox"></th>
                        <th>作者</th>
                        <th>评论</th>
                        <th>评论在</th>
                        <th>提交于</th>
                        <th>状态</th>
                        <th class="text-center" width="100">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <script src="../static/assets/vendors/art-template/template-web.js"></script>
                    <script type="text/template " id="temp">
                
                    {{  set status={
                     "held":"待审核",
                     "approved":"准许",
                     "rejected":"拒绝",
                     "trashed":"回收站"
                 }
                }}
                    {{each data as val}}
                    <tr>
                        <td class="text-center"><input type="checkbox"></td>
                        <td>{{val.author}}</td>
                        <td>{{val.content}}</td>
                        <td>{{val.title}}</td>
                        <td>{{val.created}}</td>
                        <td>{{status[val.status]}}</td>
                        <td class="text-center">
                            <a href="post-add.php" class="btn btn-warning btn-xs">驳回</a>
                            <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                        </td>
                    </tr>
                    {{/each}} 
                                        
                </script>
                    <!-- <tr class="danger">
                        <td class="text-center"><input type="checkbox"></td>
                        <td>大大</td>
                        <td>楼主好人，顶一个</td>
                        <td>《Hello world》</td>
                        <td>2016/10/07</td>
                        <td>未批准</td>
                        <td class="text-center">
                            <a href="post-add.php" class="btn btn-info btn-xs">批准</a>
                            <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                        </td>
                    </tr> -->
                   
                </tbody>
            </table>
        </div>
    </div>

    <!-- <div class="aside">
        <div class="profile">
            <img class="avatar" src="../static/uploads/avatar.jpg">
            <h3 class="name">布头儿</h3>
        </div>
        <ul class="nav">
            <li>
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
            <li class="active">
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
    <?php
	echo $current_page = "comments";
?>  
  
<?php include_once "public/_aside.php"; ?>

    <script src="../static/assets/vendors/jquery/jquery.js"></script>
    <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script src="../static/assets/vendors/twbs-pagination/jquery.twbsPagination.js"></script>
    <script>
        NProgress.done()
    </script>
    <script>
    $(function(){
        var pageSize=10;
        var currentPage=1;
        var pageCount;
        render();
        function render(){
            $.ajax({
            type:"post",
            url:"../api/_getcomment.php",
            data:{
                "pageSize":pageSize,
                "currentPage":currentPage

            },
            dataType:"json",
            success:function(res){
                console.log(res);
                if(res.code==1){
                    console.log(res);
                    var data=res.data;
                    pageCount=res.maxPage;
                    var html=template("temp",res);
                    $("tbody").html(html);

                    $(".pagination").twbsPagination({
                    totalPages: pageCount,
                    visiblePages: 5,
                    onPageClick: function(event, page) {
                        currentPage = page;
                        render();
                    }
                })
                }
            }
            
        })
        }
    })
    </script>
</body>

</html>