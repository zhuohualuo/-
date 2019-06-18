<?php
    header("Content-Type:text/html;charset=utf-8");
    require_once "config.php";
    require_once "functions.php";
    // 获取提交的id
    $categoryId = $_GET["categoryId"];
    /*// 连接数据库
    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    $sql = "SELECT p.title,p.created,p.content,p.views,p.likes,p.feature,c.`name`,u.nickname,
            (SELECT count(id) FROM comments WHERE post_id = p.id) as commentsCount
            FROM posts p
            LEFT JOIN users u ON u.id = p.user_id
            LEFT JOIN categories c ON c.id = p.category_id
            WHERE p.category_id = {$categoryId}
            ORDER BY p.created DESC
            LIMIT 10";
    $postResult = mysqli_query($connect, $sql);
    // 获取到数据集
    while ($row = mysqli_fetch_assoc($postResult)) {
        $postArr[] = $row;
    }*/
    //------调用封装后代码-----------------------------------------
    $connect = connect();
    $sql = "SELECT p.id,p.title,p.created,p.content,p.views,p.likes,p.feature,c.`name`,u.nickname,
            (SELECT count(id) FROM comments WHERE post_id = p.id) as commentsCount
            FROM posts p
            LEFT JOIN users u ON u.id = p.user_id
            LEFT JOIN categories c ON c.id = p.category_id
            WHERE p.category_id = {$categoryId}
            ORDER BY p.created DESC
            LIMIT 10";
    $postArr = query($connect, $sql);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="static/assets/css/style.css">
  <link rel="stylesheet" href="static/assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
    <?php include_once "public/_header.php" ?>
    <?php include_once "public/_aside.php" ?>
    <div class="content">
      <div class="panel new">
        <h3><?php echo $postArr[0]["name"] ?></h3>
        <?php
          foreach ($postArr as $value) {
        ?>
          <div class="entry">
            <div class="head">
              <a href="detail.php?postId=<?php echo $value["id"] ?>"><?php echo $value["title"] ?></a>
            </div>
            <div class="main">
              <p class="info"><?php echo $value["nickname"] ?> 发表于 <?php echo $value["created"] ?></p>
              <p class="brief"><?php echo $value["content"] ?></p>
              <p class="extra">
                <span class="reading">阅读(<?php echo $value["views"] ?>)</span>
                <span class="comment">评论(<?php echo $value["commentsCount"] ?>)</span>
                <a href="javascript:;" class="like">
                  <i class="fa fa-thumbs-up"></i>
                  <span>赞(<?php echo $value["likes"] ?>)</span>
                </a>
                <a href="javascript:;" class="tags">
                  分类：<span><?php echo $value["name"] ?></span>
                </a>
              </p>
              <a href="javascript:;" class="thumb">
                <img src="<?php echo $value["feature"] ?>" alt="">
              </a>
            </div>
          </div>
        <?php
          }
        ?>

        <!-- 点击加载更多 -->
        <div class="loadmore">
            <span class="btn">加载更多</span>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
  <script type="text/template" id="tmpItems">
      <% for(var i = 0; i < data.length; i++) { %>
          <div class="entry">
            <div class="head">
              <a href="detail.php?postId=<%= data[i]['id'] %>"><%= data[i]["title"] %></a>
            </div>
            <div class="main">
              <p class="info"><%= data[i]["nickname"] %> 发表于 <%= data[i]["created"] %></p>
              <p class="brief"><%= data[i]["content"] %></p>
              <p class="extra">
                <span class="reading">阅读(<%= data[i]["views"] %>)</span>
                <span class="comment">评论(<%= data[i]["commentsCount"] %>)</span>
                <a href="javascript:;" class="like">
                  <i class="fa fa-thumbs-up"></i>
                  <span>赞(<%= data[i]["likes"] %>)</span>
                </a>
                <a href="javascript:;" class="tags">
                  分类：<span><%= data[i]["name"] %></span>
                </a>
              </p>
              <a href="javascript:;" class="thumb">
                <img src="<%= data[i]["feature"] %>" alt="">
              </a>
            </div>
          </div>
      <% } %>
  </script>
  <script src="static/assets/vendors/jquery/jquery.min.js"></script>
  <script src="static/assets/vendors/art-template/template-native.js"></script>
  <script>
      $(function() {
          var currentPage = 1;
          // 加载更多
          $(".panel").on("click", ".btn", function() {
              var categoryId = location.search.split("=")[1];
              currentPage++
              // 发起请求
              $.ajax({
                  type: "post",
                  url: "api/_getMorePost.php",
                  data: {
                      "categoryId": categoryId,
                      "currentPage": currentPage,
                      "currentSize": 10
                  },
                  success: function(res) {
                      // console.log(res)
                      var str = template("tmpItems", res);
                      $('.panel')[0].innerHTML += str;
                      $('.panel').append($(".loadmore"))

                      var maxPage = Math.ceil(res.pageCount / 10);
                      
                      if(maxPage == currentPage) {
                          $(".loadmore").hide();
                      }
                  }
              })
          })
      })
  </script>
</body>
</html>