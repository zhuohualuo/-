<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Add new post &laquo; Admin</title>
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
        <nav class="navbar">
            <button class="btn btn-default navbar-btn fa fa-bars"></button>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="profile.html"><i class="fa fa-user"></i>个人中心</a></li>
                <li><a href="login.html"><i class="fa fa-sign-out"></i>退出</a></li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="page-title">
                <h1>写文章</h1>
            </div>
            <!-- 有错误信息时展示 -->
            <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
            <form class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="title">标题</label>
                        <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
                    </div>
                    <div class="form-group">
                        <label for="content">标题</label>
                        <textarea id="content" class="form-control input-lg" name="content" cols="30" rows="10" placeholder="内容"></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="slug">别名</label>
                        <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
                        <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
                    </div>
                    <div class="form-group">
                        <label for="feature">特色图像</label>
                        <!-- show when image chose -->
                        <img id="image" class="help-block thumbnail" style="display: none">
                        <input id="feature" class="form-control" name="feature" type="file">
                    </div>
                    <div class="form-group">
                        <label for="category">所属分类</label>
                        <select id="category" class="form-control" name="category">
              <option value="1">未分类</option>
              <option value="2">潮生活</option>
            </select>
                    </div>
                    <div class="form-group">
                        <label for="created">发布时间</label>
                        <input id="created" class="form-control" name="created" type="datetime-local">
                    </div>
                    <div class="form-group">
                        <label for="status">状态</label>
                        <select id="status" class="form-control" name="status">
              <option value="drafted">草稿</option>
              <option value="published">已发布</option>
            </select>
                    </div>
                    <div class="form-group">
                        <input type="button" value="保存" class="btn btn-primary" id="btn-save">
                    </div>
                </div>
            </form>
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
            <li class="active">
                <a href="#menu-posts" data-toggle="collapse">
                    <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
                </a>
                <ul id="menu-posts" class="collapse in">
                    <li><a href="posts.html">所有文章</a></li>
                    <li class="active"><a href="post-add.html">写文章</a></li>
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
    <?php echo $current_page = "post-add"; ?>
    <?php include_once "./public/_aside.php" ?>

    <script src="../static/assets/vendors/jquery/jquery.js"></script>
    <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script src="../static/assets/vendors/ckeditor/ckeditor.js">//使用插件完成基本功能</script>
    <script>
	$(function() {
      	CKEDITOR.replace("content");
	})
</script>
    <script>
        NProgress.done()
    </script>
    <script>
    $(function(){

        $("#feature").on('change',function(){
                var file=this.files[0];
                // jQuery无法直接获取文件,需要通过formdata获取
                var data=new FormData();
                data.append("file",file);
    
            $.ajax({
            type:"post",
            url:"../api/_getpostsadd.php",
            data:data,
            // 配置相关参数，才能带回服务端
          	contentType: false,// 只有设置了这个参数，才能把文件带回服务端
          	processData: false,// 告诉jq不要序列化参数
            dataType:"json",
            success:function(res){
                if(res.code==1){
                    $("#image").show().attr("src",res.src);
                }
                
            }
        })
    })
    //完成数据的储存
    $("#btn-save").on("click",function(){
        var src=$("#image").attr("src");
        //获取文本域的内容
        CKEDITOR.instances.content.updateElement();
    if(src){

        var data=$(".row").serialize()+"&feature="+src;
    }else{
        var data=$(".row").serialize()+"&feature=";
    }
        console.log(data);
        
        $.ajax({
            type:"post",
            url:"../api/_addposts.php",
            data:data,
            dataType:"json",
            success:function(res){
                if(res.code==1){
                
                    
                    // console.log('操作完成');  
                    
                    
                }
            }
        })
    })
    })
    </script>
</body>

</html>