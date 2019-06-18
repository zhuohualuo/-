<?php
//获取公共模块,登录之后操作
include_once "../config.php";
include_once "../function.php";
checkLogin();
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Categories &laquo; Admin</title>
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
            <div class="page-title">
                <h1>分类目录</h1>
            </div>
            <!-- 有错误信息时展示 -->
            <div class="alert alert-danger" style="display:none">
        <strong>错误！</strong> <div class="msg"></div>
      </div>
            <div class="row">
                <div class="col-md-4">
                    <form id="data">
                        <h2>添加新分类目录</h2>
                        <div class="form-group">
                            <label for="name">名称</label>
                            <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
                        </div>
                        <div class="form-group">
                            <label for="slug">别名</label>
                            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
                            <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
                        </div>
                        <div class="form-group">
                            <label for="slug">类名</label>
                            <input id="className" class="form-control" name="className" type="text" placeholder="className">
                            <p class="help-block">https://zce.me/category/<strong>类名</strong></p>
                        </div>
                        <div class="form-group">
                            <!-- <button class="btn btn-primary" type="submit" id="btn-add">添加</button> -->
                            <input type="button" id="btn-add" value="添加" >
                            <input type="button" id="btn-ok" value="编辑完成" style="display:none">
                            <input type="button" id="btn-cancel" value="取消编辑" style="display:none">
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="page-action">
                        <!-- show when multiple checked -->
                        <a id="delAll" class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" width="40"><input type="checkbox"></th>
                                <th>名称</th>
                                <th>Slug</th>                      
                                <th>类名</th>                      
                                <th class="text-center" width="100">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <script src="../static/assets/vendors/art-template/template-web.js"></script>
                            <script type="text/template" id="temp">
                            {{each data  val }}
                            <tr categoryId={{val.id}}>
                                <td class="text-center"><input type="checkbox"></td>
                                <td>{{val.name}}</td>
                                <td>{{val.slug}}</td>
                                <td>{{val.classname}}</td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btn btn-info btn-xs data-category edit" data-categoryId={{val.id}}>编辑</a>
                                    <a href="javascript:;" class="btn btn-danger btn-xs del">删除</a>
                                </td>
                            </tr>
                            {{/each}}
                            </script>
                            <!-- <tr>
                                <td class="text-center"><input type="checkbox"></td>
                                <td>未分类</td>
                                <td>uncategorized</td>
                                <td>fa_fire</td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="checkbox"></td>
                                <td>未分类</td>
                                <td>uncategorized</td>
                                <td>fa_fire</td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="checkbox"></td>
                                <td>未分类</td>
                                <td>uncategorized</td>
                                <td>fa_fire</td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                                </td>
                            </tr> -->
                            <script src="../static/assets/vendors/art-template/template-web.js"></script>
                            <script type="text/template" id="temp2">
                            {{each value}}
                            <tr>
                                <td class="text-center"><input type="checkbox"></td>
                                <td>name</td>
                                <td>slug</td>
                                <td>className</td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                                </td>
                            </tr>
                            {{/each}}
                            </script>
                        </tbody>
                    </table>
                </div>
            </div>
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
                    <li><a href="post-add.html">写文章</a></li>
                    <li class="active"><a href="categories.html">分类目录</a></li>
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
    <?php
	echo $current_page = "categories";
?> 
<?php include_once "public/_aside.php"; ?>

    <script src="../static/assets/vendors/jquery/jquery.js"></script>
    <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script>
        NProgress.done()
    </script>

   <script>
    $(function(){
        render();
       function render(){
        $.ajax({
        type:"post",
        url:"../api/_getcategoriesData.php",
        success:function(res){
            // 如果code结果为1,则渲染结果
            if(res.code==1){
                //利用模板引擎接收数据
                var html=template("temp",res);
                $("tbody").html(html)
            }
        }
    })
       };
  //添加点击事件
  $("#btn-add").on("click",function(){
      console.log('hh');
      //非空验证
      var name=$("#name").val();
      var slug=$("#slug").val();
      var className=$("#className");
      if(name==""){
        $(".alert").show();
        $(".msg").text("用户名不能为空");
        return;
      }
      if(slug==""){
          $(".alert").show();
          $(".msg").text("别名不能为空");
          return;
      }
      if(className==""){
          $(".alert").show();
          $(".msg").text("类名不能为空");
          return;
      }
      
      $.ajax({
          type:"post",
          url:"../api/_getaddcategories.php",
          data: $("#data").serialize(),
          dateType:"json",
          success:function(res){
              //渲染页面
              console.log(res);
             if(res.code==1){
                 render();
             }else{
                 $(".alert").show();
                 $(".msg").text("数据库重复,请换一个");
             }

          }
      })
  })
//点击编辑事件
$("tbody").on("click",".edit",function(){
    $("#btn-add").hide();
   $("#btn-ok,#btn-cancel").show();
    var categoryId=$(this).attr("data-categoryId");
    $("#btn-ok").attr("data-category",categoryId);
    var name=$(this).parents("tr").children().eq(1).text();
    var slug=$(this).parents("tr").children().eq(2).text();
    var className=$(this).parents("tr").children().eq(3).text();
    $("#name").val(name);
    $("#slug").val(slug);
    $("#className").val(className);

})
//点击确认编辑事件
$("#btn-ok").on("click",function(){
    var categoryId=$("#btn-ok").attr("data-category");
    var name=$("#name").val();
    var slug=$("#slug").val();
    var className=$("#className").val();
    //不能为空
    if($.trim(name)==""){
        $(".alert").show().children(".msg").show();
        return;
    }
    if($.trim(slug)==""){
        $(".alert").show().children(".msg").show();
        return;
    }
    if($.trim(className)==""){
        $(".alert").show().children(".msg").show();
        return;

    };
    // console.log(categoryId,name,slug,className)
    $.ajax({
        type:"post",
        url:"../api/_geteditcategory.php",
        data:{
            "categoryId":categoryId,
            "name":name,
            "slug":slug,
            "className":className
        },
        dataType:"json",
        success:function(res){
            console.log(res);
            if(res.code==1){
                //渲染页面
              $("#btn-ok,#btn-cancel").hide();
              $("#btn-add").show();
              $("#name").val("");
              $("#slug").val("");
              $("#className").val("");
              render();
            }
            

        }
    })

})
//点击取消编辑事件
$("#btn-cancel").on("click",function(){
    $("#btn-ok,#btn-cancel").hide();
    $("#btn-add").show();
    $("#name").val("");
     $("#slug").val("");
     $("#className").val("");
    
})
//点击删除事件
$("tbody").on("click",".del",function(){
    var tr=$(this).parents("tr");
    var id=tr.attr("categoryId");
    console.log(id);
    
    $.ajax({
        type:"post",
        url:"../api/_getdelcategories.php",
        data:{
            "id":id
        },
        success:function(res){
            console.log(res);
            render();
        }
    })
})
//点击批量删除事件
$("thead input:checkbox").on("click",function(){
    var statu=$(this).prop("checked");
    $("tbody input:checkbox").prop("checked",statu);
    //如果选中,显示上面的批量删除按钮
    if(statu){
        $("#delAll").show();
    }else{
        $("#delAll").hide();
    };
})
//点击下面的input删除事件
$("tbody").on("click",":checkbox",function(){
    var cxk= $("tbody :checked").length
    // console.log(cxk);
    
    $("thead :checkbox").prop("checked",$("tbody :checkbox").length==cxk)
    cxk>=2 ?$("#delAll").show():$("#delAll").hide();
})
//点击批量删除事件
$("#delAll").on("click",function(){
    //收集所有选中的id
    var ids=[];
    var aaa=$("tbody :checked");
    console.log(aaa);
    
    aaa.each(function(index,el){
        var id=$(el).parents("tr").attr("categoryId");
        ids.push(id);
    
})
$.ajax({
        type:"post",
        url:"../api/_getdelcategory.php",
        dataType:"json",
        data:{
            'id':ids
        },
        success:function(res){
        if(res.code==1){
            $("tbody :checked").parents("tr").remove();
        }
            
            
        }
    })
})
})
    </script> 
    
</body>

</html>