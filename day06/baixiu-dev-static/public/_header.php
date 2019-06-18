<?php
    // 1.0 连接数据库
    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    // 1.1 编辑sql语句
    $sql = "SELECT * FROM categories WHERE id != 1";
    // 1.2 执行sql语句
    $result = mysqli_query($connect, $sql);
    // 2.0 循环拿到数据集中的内容
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
?>
<div class="header">
      <h1 class="logo"><a href="index.php"><img src="static/assets/img/logo.png" alt=""></a></h1>  
      <ul class="nav">
        <?php
          foreach ($arr as $value) {
        ?>
              <li>
                <a href="list.php?categoryId=<?php echo $value["id"] ?>">
                  <i class="fa <?php echo $value["classname"] ?>"></i>
                  <?php echo $value["name"] ?>
                </a>
              </li>
        <?php
          }
        ?>
      </ul>
      <div class="search">
        <form>
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
      </div>
</div>
