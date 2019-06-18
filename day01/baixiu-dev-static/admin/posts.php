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
          <select name="" class="form-control input-sm">
            <option value="">所有分类</option>
            <option value="">未分类</option>
          </select>
          <select name="" class="form-control input-sm">
            <option value="">所有状态</option>
            <option value="">草稿</option>
            <option value="">已发布</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
        </form>
        <ul  class="pagination pagination-sm pull-right">
         
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
         <script src="../static/assets/vendors/art-template/template-web.js"></script>
         <script type="text/template" id="temp">
         {{each data as val}}
         <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>{{val.title}}</td>
            <td>{{val.nickname}}</td>
            <td>{{val.name}}</td>
            <td class="text-center">{{val.created}}</td>
            <td class="text-center">{{status[val.status]}}</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          {{/each}}
          <!-- <% for(var i=0;i<data.length;i++){ % >
            <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td><%= data[i].author %></td>
            <td><%=data[i].nickname %></td>
            <td><%=data[i].name %></td>
            <td class="text-center"><%=data[i].created %></td>
            <td class="text-center"><%=data[i].status %></td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <% } %> -->
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
  

  <script>
    NProgress.done();

    $("#delAll").hide()
  </script>
  <script>
 $(function(){
  var statu = {
            "drafted": "草稿",           
            "published": "已发布",
            "trashed": "已作废"
        };
     //页面渲染
    $.ajax({
      type:'post',
      url:'../api/_getpostsdata.php',
      dataType:'json',
      success:function(res){
          console.log(res);
          var data=res.data;
          res.status=statu;
          var html=template("temp",res)
          $("tbody").html(html)
      }
  })
  //页面分页
//   每页的数据个数
  var pageSize=10;
  //最大页码数
  var maxPage=4;
  //当前页码
  var currentPage=1;
  //根据当前页计算出开始页码和结束页码
  var start=currentPage-2;
  start=start<1?1:start;
  var end =currentPage+4;
  end=end>maxPage?maxPage:end;
  //动态生成页面结构
  var html="";
  if(currentPage!=1){

  html+= '<li class="item" data-page='+(currentPage-1)+'><a href="javascript:;">上一页</a></li>';
  }
  for(var i=start;i<=end;i++){
      if(i==currentPage){
      html+='<li class="item active" data-page="'+i+'"><a href="#">'+i+'</a></li>';
      }else{

      html+='<li class="item "><a href="#">'+i+'</a></li>';
      }
  };
  if(currentPage!=maxPage){

  html+="<li class='item' data-page='"+(currentPage+1)+"'><a href='javascript:;'>下一页</a></li>";
  }
$(".pagination").html(html);


        


 })
  </script>
</body>
</html>
  
