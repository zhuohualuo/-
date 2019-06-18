<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
  <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">

    <?php include_once "public/_navbar.php"; ?>
    
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有文章</h1>
        <a href="post-add.php" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a id="delAll" class="btn btn-danger btn-sm" href="javascript:;">批量删除</a>
        <form class="form-inline">
          <select id="category" name="" class="form-control input-sm">
            <option value="all">所有分类</option>
          </select>
          <select id="status" name="" class="form-control input-sm">
            <option value="all">所有状态</option>
            <option value="drafted">草稿</option>
            <option value="published">已发布</option>
            <option value="trashed">已删除</option>
          </select>
          <input id="btn-filt" class="btn btn-default btn-sm" type="button" value="筛选">
        </form>
        <ul class="pagination pagination-sm pull-right">
          <!-- 动态生成的页码 -->
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <!-- <script type="text/template">
              <%
                  var status = {
                          "drafted": "草稿",           
                          "published": "已发布",
                          "trashed": "已作废"
                  };
              %>
              <% for(var i = 0; i < data.length; i++) { %>
                <tr>
                  <td class="text-center"><input type="checkbox"></td>
                  <td><%= data[i].title %></td>
                  <td><%= data[i].nickname %></td>
                  <td><%= data[i].name %></td>
                  <td class="text-center"><%= data[i].created %></td>
                  <td class="text-center"><%= status[data[i].status] %></td>
                  <td class="text-center">
                    <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                  </td>
                </tr>
              <% } %>
          </script> -->
          <script type="text/template" id="tempId">
              {{ each data as val }}
                  <tr>
                  <td class="text-center"><input type="checkbox"></td>
                  <td>{{ val.title }}</td>
                  <td>{{ val.nickname }}</td>
                  <td>{{ val.name }}</td>
                  <td class="text-center">{{ val.created }}</td>
                  <td class="text-center">{{ status[val.status] }}</td>
                  <td class="text-center">
                    <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                  </td>
                </tr>
              {{ /each }}
          </script>
        </tbody>
      </table>
    </div>
  </div>
  <?php 
    $current_page = "posts";
  ?>
  <?php include_once "public/_aside.php"; ?>
  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../static/assets/vendors/art-template/template.js"></script>
  <script>
    NProgress.done();
    $("#delAll").hide()

    // 开始实际的业务处理
    $(function() {
        // 声明每页要获取的条数
        var pageSize = 10;
        // 声明当前的页码
        var currentPage = 1;
        // 声明最大的页码
        var maxPageCount = 4;
        
        function makPageButton() {
            // 声明起始的页码
            var start = currentPage - 2;
            start = start < 1 ? 1 : start;
            // 声明结束的页码
            var end = start + 4;
            end = end > maxPageCount ? maxPageCount : end;

            // 1.0 动态拼接结构
            var html = "";
            if(currentPage != 1) {
                html += '<li class="item" data-page="'+ (currentPage - 1) +'"><a href="javascript:;">上一页</a></li>';
            }
            for(var i = 1; i <= end; i++) {
              if(currentPage == i) {
                  html += '<li class="item active" data-page="'+ i +'"><a href="javascript:;">'+ i +'</a></li>';
              } else {
                  html += '<li class="item" data-page="'+ i +'"><a href="javascript:;">'+ i +'</a></li>';
              }
            }
            if(currentPage != maxPageCount) {
                html += '<li class="item" data-page="'+ (currentPage + 1) +'"><a href="javascript:;">下一页</a></li>';
            }
            $(".pagination").html(html);
        }


        // 声明数据结构中需要转义的内容，用对象保存
        var status = {
            "drafted": "草稿",           
            "published": "已发布",
            "trashed": "已作废"
        };

        // 2.0 页面打开就加载所有的文章
        $.ajax({
            type: "post",
            url: "api/_getPostData.php",
            data: {
                    "currentPage": currentPage,
                    "pageSize": pageSize,
                    "status": $("#status").val(),
                    "categoryId": $("#category").val()
                },
            success: function(res) {
                if(res.code == 1) {
                    maxPageCount = res.maxCount;
                    makPageButton();
                    // 在返回的数据对象中补充一条对象数据
                    res.status = status;
                    // 调用模板方法，拼接完成的内容
                    var html = template("tempId", res);
                    // 在内容中写入
                    $("tbody").html(html);
                }
            }
        })

        // 2.1 页面打开就加载所有的分类
        $.ajax({
            type: "post",
            url: "api/_getCategoryData.php",
            success: function(res) {
                if(res.code == 1) {
                    var data = res.data;
                    $.each(data, function(index, el) {
                      var str = '<option value="'+ el.id +'">'+ el.name +'</option>';
                      // 拿到当前的数据，追加到页面中
                      $(str).appendTo("#category")
                    });
                }
            }
        }) 
        

        // 3.0 给页码按钮注册事件，通过事件委托的方式
        $(".pagination").on("click", ".item", function() {
            // 获取到当前页码
            currentPage = $(this).data("page");

            // 发送ajax请求，携带当前页码、页码总数的参数
            $.ajax({
                type: "post",
                url: "api/_getPostData.php",
                data: {
                    "currentPage": currentPage,
                    "pageSize": pageSize,
                    "status": $("#status").val(),
                    "categoryId": $("#category").val()
                },
                success: function(res) {
                    if(res.code == 1) {
                        maxPageCount = res.maxCount;
                        makPageButton();
                        // 在返回的数据对象中补充一条对象数据
                        res.status = status;
                        // 调用模板方法，拼接完成的内容
                        var html = template("tempId", res);
                        // 在内容中写入
                        $("tbody").html(html);
                    }
                }
            })
        })

        // 4.0 点击筛选按钮，发起请求，渲染页面内容
        $("#btn-filt").on("click", function() {
            var inpStatus = $("#status").val();
            var categoryId = $("#category").val();
            // 携带参数发送请求
            $.ajax({
                type: "post",
                url: "api/_getPostData.php",
                data: {
                    "currentPage": currentPage,
                    "pageSize": pageSize,
                    "status": inpStatus,
                    "categoryId": categoryId
                },
                success: function(res) {
                    if(res.code == 1) {
                        // 在返回的数据对象中补充一条对象数据
                        res.status = status;
                        var html = template("tempId", res);
                        $("tbody").html(html);
                    }
                }
            })
        })
        
    })
  </script>
</body>
</html>
