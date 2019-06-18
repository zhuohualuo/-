<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap">
      <img class="avatar" src="../static/assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger">
        <strong>错误！</strong> <span id="msg"></span>
      </div>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" type="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" type="password" class="form-control" placeholder="密码">
      </div>
      <span id="btn-login" class="btn btn-primary btn-block">登 录</span>
    </form>
  </div>
  <script src="../static/assets/vendors/jquery/jquery.min.js"></script>
  <script>
    $(function() {
        $(".alert").hide();

        $("#btn-login").on("click", function() {
            // 1.0 获取表单元素中的值
            var email = $("#email").val();
            var password = $("#password").val();

            // 1.2 正则验证，
            var reg = /^\w+[@]\w+[.]\w+$/;
            if(!reg.test(email)) {
                $("#msg").text("用户邮箱输入错误");
                $(".alert").show();
                return
            }

            // 2.0 发起前端的请求，验证数据是否正确
            $.ajax({
                type: "POST",
                url: "api/_getUserLogin.php",
                data: {
                    "email": email,
                    "password": password
                },
                success: function(res) {
                    // 处理登陆成功之后的事情
                    if(res.code == 1) {
                        location.href = "index.php";
                    } else {
                        $("#msg").text("用户名或者密码错误");
                        $(".alert").show();
                    }
                }
            })
        })
    })
  </script>
</body>
</html>
