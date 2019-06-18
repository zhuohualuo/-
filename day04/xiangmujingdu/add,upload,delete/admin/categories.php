<?php
    require_once "../config.php";
    require_once "../functions.php";

    // 验证是否登陆成功
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
  <script>NProgress.start()</script>

  <div class="main">
    
    <?php include_once "public/_navbar.php"; ?>

    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger">
        <strong>错误！</strong><span id="msg"></span>
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
              <label for="classname">类名</label>
              <input id="classname" class="form-control" name="classname" type="text" placeholder="类名">
              <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <button id="btn-add" class="btn btn-primary" type="button">添加</button>
              <button id="btn-edit" class="btn btn-primary" type="button">编辑完成</button>
              <button id="btn-cancel" class="btn btn-primary" type="button">取消编辑</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a id="delAll" class="btn btn-danger btn-sm" href="javascript:;">批量删除</a>
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
              
              <script type="text/template" id="tmpId">
                  <% for(var i = 0; i < data.length; i++) { %>
                      <tr data-category-id="<%= data[i].id  %>">
                        <td class="text-center"><input type="checkbox"></td>
                        <td><%= data[i].name %></td>
                        <td><%= data[i].slug %></td>
                        <td><%= data[i].classname %></td>
                        <td class="text-center">
                          <a href="javascript:;" data-category-id="<%= data[i].id  %>" class="btn btn-info btn-xs edit">编辑</a>
                          <a href="javascript:;" class="btn btn-danger btn-xs del">删除</a>
                        </td>
                      </tr>
                  <% } %>
              </script>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php 
    $current_page = "categories";
  ?>
  <?php include_once "public/_aside.php"; ?>

  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../static/assets/vendors/art-template/template-native.js"></script>
  <script>
    NProgress.done();
    $("#btn-edit, #btn-cancel").hide();
    $(function() {
        $("#delAll, .alert").hide();

        // 1.0 渲染已经存在的分类数据
        $.ajax({
            type: "post",
            url: "api/_getCategoryData.php",
            success: function(res) {
                // 成功之后的处理
                var html = template("tmpId", res);
                $("tbody").html(html);
            }
        })

        // 2.0 点击按钮实现添加功能
        $("#btn-add").on("click", function() {
            // 2.1 收集表单数据
            var name = $("#name").val();
            var slug = $("#slug").val();
            var classname = $("#classname").val();
            // 2.2 非空验证
            if(name == "") {
                $("#msg").text("分类的名称不能为空")
                $(".alert").show()
                return
            }
            if(slug == "") {
                $("#msg").text("分类的别名不能为空")
                $(".alert").show()
                return
            }
            if(classname == "") {
                $("#msg").text("分类的图标样式为空")
                $(".alert").show()
                return
            }

            // 2.3 请求数据
            $.ajax({
                type: "post",
                url: "api/_addCategory.php",
                data: $("#data").serialize(),
                success: function(res) {
                    if(res.code == 1) {
                        var arr = [{
                          "name": name,
                          "slug": slug,
                          "classname": classname
                        }];
                        var html = template("tmpId", {"data": arr});
                        $("tbody").append(html)
                    }
                }
            })
        })

        var currentRow;
        // 3.0 使用事件委托的方式给动态渲染的结构添加事件
        $("tbody").on("click", ".edit", function(){
            var categoryId = $(this).data("categoryId");
            $("#btn-edit").attr("data-category-id", categoryId)

            // 3.1 添加按钮隐藏，编辑完成和取消编辑按钮显示
            $("#btn-add").hide();
            $("#btn-edit, #btn-cancel").show();
            // 3.2 获取 当前 行(tr)对应td的内容, parents和parent的用法不一样
            currentRow = $(this).parents("tr").children()
            var name = currentRow.eq(1).text();
            var slug = currentRow.eq(2).text();
            var classname = currentRow.eq(3).text();
            // 3.3 给表单元素写入内容
            $("#name").val(name);
            $("#slug").val(slug);
            $("#classname").val(classname);
        })

        // 4.0 拿到转存的id值，点击完成编辑，发送请求
        $("#btn-edit").click(function(){
            var categoryId = $(this).data("categoryId");
            // 4.1 收集表单数据
            var name = $("#name").val();
            var slug = $("#slug").val();
            var classname = $("#classname").val();
            // 4.2 非空验证
            if(name == "") {
                $("#msg").text("分类的名称不能为空")
                $(".alert").show()
                return
            }
            if(slug == "") {
                $("#msg").text("分类的别名不能为空")
                $(".alert").show()
                return
            }
            if(classname == "") {
                $("#msg").text("分类的图标样式为空")
                $(".alert").show()
                return
            }
            
            $.ajax({
                type: "post",
                url: "api/_updateCategory.php",
                data: {
                    "name": name,
                    "slug": slug,
                    "classname": classname,
                    "id": categoryId
                },
                success: function(res) {
                    if(res.code == 1) {
                        $("#btn-edit, #btn-cancel").hide();
                        $("#btn-add").show()

                        var name = $("#name").val()
                        var slug = $("#slug").val()
                        var classname = $("#classname").val()

                        $("#name, #slug, #classname").val("");

                        currentRow.eq(1).text(name);
                        currentRow.eq(2).text(slug);
                        currentRow.eq(3).text(classname);
                    }
                }
            })
        })

        // 5.0 取消编辑
        $("#btn-cancel").click(function() {
            $("#btn-edit, #btn-cancel").hide();
            $("#btn-add").show()
            $("#name, #slug, #classname").val("");
        })

        // 6.0 删除对应的分类
        $("tbody").on("click", ".del", function() {
            var row = $(this).parents("tr");
            var categoryId = row.data("categoryId");

            $.ajax({
                type: "post",
                url: "api/_delCategory.php",
                data: {
                    "id": categoryId
                },
                success: function(res) {
                    if(res.code == 1) {
                        row.remove();
                    }
                }
            })
        })

        // 7.0 批量删除的按钮
        $("thead :checkbox").on("click", function() {
            var isChecked = $(this).prop("checked");
            $("tbody :checkbox").prop("checked", isChecked)
            if(isChecked) {
                $("#delAll").show();
            } else {
                $("#delAll").hide();
            }
        })

        $("tbody").on("click", ":checkbox", function() {
            $("thead :checkbox").prop("checked", $("tbody :checkbox").size() == $("tbody :checked").size())

            if($("tbody :checked").size() >= 2) {
                $("#delAll").show();
            } else {
                $("#delAll").hide();
            }
        })

        $("#delAll").on("click", function() {
            var idArr = [];
            var cks = $("tbody :checked");

            cks.each(function(index, el) {
                idArr.push($(el).parents("tr").data("categoryId"))
            });

            $.ajax({
                type: "post",
                url: "api/_delCategories.php",
                data: {
                  "ids": idArr
                },
                success: function(res) {
                    if(res.code == 1) {
                        cks.parents("tr").remove();
                    }
                }
            })
        })


    })
  </script>
</body>
</html>
