<?php
require_once "./config.php";
require_once "./function.php";
$categoryId=$_GET["categoryId"];

$sql="SELECT p.id,p.title,p.created,p.content,p.views,p.likes,p.feature,u.nickname,c.name,
(SELECT count(id) FROM comments WHERE comments.post_id = p.id) as commentCount
FROM posts p
LEFT JOIN users u ON u.id = p.user_id
LEFT JOIN categories c ON c.id = p.category_id
WHERE p.category_id = {$categoryId}
LIMIT 10";
$conn=connect();
$arr3=query($conn,$sql);
// print_r($arr3);

//获取点击过来的标题文件
// $categoryId=$_GET["categoryId"];
// // print_r($_GET);
// $conn=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);
// // print_r($conn);
// $sql="SELECT p.title,p.created,p.content,p.views,p.likes,p.feature,u.nickname,c.name,
// (SELECT count(id) FROM comments WHERE comments.post_id = p.id) as commentCount
// FROM posts p

// LEFT JOIN users u ON u.id = p.user_id
// LEFT JOIN categories c ON c.id = p.category_id
// WHERE p.category_id = $categoryId
// LIMIT 10";
// $res=mysqli_query($conn,$sql);
// // print_r($res);
// // $arr=[];
// while($row=mysqli_fetch_assoc($res)){
//     $arr3[]=$row;
// }
// // print_r($arr);
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
        <!-- <div class="header">
            <h1 class="logo">
                <a href="index.html"><img src="static/assets/img/logo.png" alt=""></a>
            </h1>
            <ul class="nav">
              <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
                <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
                <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
                <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li> 
               
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
        </div> -->
        <!-- <div class="aside">
            <div class="widgets">
                <h4>搜索</h4>
                <div class="body search">
                    <form>
                        <input type="text" class="keys" placeholder="输入关键字">
                        <input type="submit" class="btn" value="搜索">
                    </form>
                </div>
            </div>
            <div class="widgets">
                <h4>随机推荐</h4>
                <ul class="body random">
                    <li>
                        <a href="javascript:;">
                            <p class="title">废灯泡的14种玩法 妹子见了都会心动</p>
                            <p class="reading">阅读(819)</p>
                            <div class="pic">
                                <img src="static/uploads/widget_1.jpg" alt="">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <p class="title">可爱卡通造型 iPhone 6防水手机套</p>
                            <p class="reading">阅读(819)</p>
                            <div class="pic">
                                <img src="static/uploads/widget_2.jpg" alt="">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <p class="title">变废为宝！将手机旧电池变为充电宝的Better</p>
                            <p class="reading">阅读(819)</p>
                            <div class="pic">
                                <img src="static/uploads/widget_3.jpg" alt="">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <p class="title">老外偷拍桂林芦笛岩洞 美如“地下彩虹”</p>
                            <p class="reading">阅读(819)</p>
                            <div class="pic">
                                <img src="static/uploads/widget_4.jpg" alt="">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <p class="title">doge神烦狗打底南瓜裤 就是如此魔性</p>
                            <p class="reading">阅读(819)</p>
                            <div class="pic">
                                <img src="static/uploads/widget_5.jpg" alt="">
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="widgets">
                <h4>最新评论</h4>
                <ul class="body discuz">
                    <li>
                        <a href="javascript:;">
                            <div class="avatar">
                                <img src="static/uploads/avatar_1.jpg" alt="">
                            </div>
                            <div class="txt">
                                <p>
                                    <span>鲜活</span>9个月前(08-14)说:
                                </p>
                                <p>挺会玩的</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <div class="avatar">
                                <img src="static/uploads/avatar_1.jpg" alt="">
                            </div>
                            <div class="txt">
                                <p>
                                    <span>鲜活</span>9个月前(08-14)说:
                                </p>
                                <p>挺会玩的</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <div class="avatar">
                                <img src="static/uploads/avatar_2.jpg" alt="">
                            </div>
                            <div class="txt">
                                <p>
                                    <span>鲜活</span>9个月前(08-14)说:
                                </p>
                                <p>挺会玩的</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <div class="avatar">
                                <img src="static/uploads/avatar_1.jpg" alt="">
                            </div>
                            <div class="txt">
                                <p>
                                    <span>鲜活</span>9个月前(08-14)说:
                                </p>
                                <p>挺会玩的</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <div class="avatar">
                                <img src="static/uploads/avatar_2.jpg" alt="">
                            </div>
                            <div class="txt">
                                <p>
                                    <span>鲜活</span>9个月前(08-14)说:
                                </p>
                                <p>挺会玩的</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <div class="avatar">
                                <img src="static/uploads/avatar_1.jpg" alt="">
                            </div>
                            <div class="txt">
                                <p>
                                    <span>鲜活</span>9个月前(08-14)说:
                                </p>
                                <p>挺会玩的</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div> -->
        <?php include_once "./public/_header.php"?>
        <?php include_once "./public/_aside.php"?>
        <div class="content">
            <div class="panel new">
                <h3><?php echo $arr3[0]["name"]?></h3>
                <?php foreach($arr3 as $k=>$val) {?>
                <div class="entry">
                    <div class="head">
                        <span class="sort"><?php echo $val["name"]?></span>
                        <a href="detail.php?postId=<?php echo $val["id"]?>;"><?php echo $val["title"]?></a>
                    </div>
                    <div class="main">
                        <p class="info"><?php echo $val["nickname"]?> 发表于 <?php echo $val["created"]?></p>
                        <p class="brief"><?php echo $val["content"]?></p>
                        <p class="extra">
                            <span class="reading">阅读(<?php echo $val["views"]?>)</span>
                            <span class="comment">评论(<?php echo $val["commentCount"]?>)</span>
                            <a href="javascript:;" class="like">
                                <i class="fa fa-thumbs-up"></i>
                                <span>赞(<?php echo $val["likes"]?>)</span>
                            </a>
                            <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
                        </p>
                        <a href="list.php?createdid=<?php echo $val["id"]?>;" class="thumb">
                            <img src="./static/uploads/widget_5.jpg" alt="">
                        </a>
                    </div>
                </div>
<?php } ?>
                <!-- <div class="entry">
                    <div class="head">
                        <a href="javascript:;">星球大战：原力觉醒视频演示 电影票68</a>
                    </div>
                    <div class="main">
                        <p class="info">admin 发表于 2015-06-29</p>
                        <p class="brief">星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯</p>
                        <p class="extra">
                            <span class="reading">阅读(3406)</span>
                            <span class="comment">评论(0)</span>
                            <a href="javascript:;" class="like">
                                <i class="fa fa-thumbs-up"></i>
                                <span>赞(167)</span>
                            </a>
                            <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
                        </p>
                        <a href="javascript:;" class="thumb">
                            <img src="static/uploads/hots_2.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="entry">
                    <div class="head">
                        <a href="javascript:;">星球大战：原力觉醒视频演示 电影票68</a>
                    </div>
                    <div class="main">
                        <p class="info">admin 发表于 2015-06-29</p>
                        <p class="brief">星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯</p>
                        <p class="extra">
                            <span class="reading">阅读(3406)</span>
                            <span class="comment">评论(0)</span>
                            <a href="javascript:;" class="like">
                                <i class="fa fa-thumbs-up"></i>
                                <span>赞(167)</span>
                            </a>
                            <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
                        </p>
                        <a href="javascript:;" class="thumb">
                            <img src="static/uploads/hots_2.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="entry">
                    <div class="head">
                        <a href="javascript:;">星球大战：原力觉醒视频演示 电影票68</a>
                    </div>
                    <div class="main">
                        <p class="info">admin 发表于 2015-06-29</p>
                        <p class="brief">星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯</p>
                        <p class="extra">
                            <span class="reading">阅读(3406)</span>
                            <span class="comment">评论(0)</span>
                            <a href="javascript:;" class="like">
                                <i class="fa fa-thumbs-up"></i>
                                <span>赞(167)</span>
                            </a>
                            <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
                        </p>
                        <a href="javascript:;" class="thumb">
                            <img src="static/uploads/hots_2.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div> -->
      
  
        <div class="box">
            <div class="btn">加载更多</div>
        </div>
        <div class="footer">
            <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
        </div>
    </div>
    <script src="./static/assets/vendors/art-template/template-web.js"></script>
     <!-- <script type="text/template" id="temp">
     <% for(var i=0;i<data.length;i++){ %>
     <div class="entry">
                    <div class="head">
                        <span class="sort"><%= data[i].name%></span>
                        <a href="detail.php?postId=<%= data[i].id%>;"><%= data[i].title %></a>
                    </div>
                    <div class="main">
                        <p class="info"><%= data[i].nickname%> 发表于 <%= data[i].created%></p>
                        <p class="brief"><%= data[i].content%></p>
                        <p class="extra">
                            <span class="reading">阅读(<%= data[i].views%>)</span>
                            <span class="comment">评论(<%= data[i].commentCount%>)</span>
                            <a href="javascript:;" class="like">
                                <i class="fa fa-thumbs-up"></i>
                                <span>赞(<%= data[i].likes%>)</span>
                            </a>
                            <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
                        </p>
                        <a href="list.php?createdid=<%= data[i].id%>;" class="thumb">
                            <img src="./static/uploads/widget_5.jpg" alt="">
                        </a>
                    </div>
                </div>
    <% }%> -->
    <script type="text/template" id="temp">
     <% for(var i=0;i<res.data.length;i++){ %>
     <div class="entry">
                    <div class="head">
                        <span class="sort"><%= res.data[i].name%></span>
                        <a href="detail.php?postId=<%= res.data[i].id%>;"><%= res.data[i].title %></a>
                    </div>
                    <div class="main">
                        <p class="info"><%= res.data[i].nickname%> 发表于 <%= res.data[i].created%></p>
                        <p class="brief"><%= res.data[i].content%></p>
                        <p class="extra">
                            <span class="reading">阅读(<%= res.data[i].views%>)</span>
                            <span class="comment">评论(<%= res.data[i].commentCount%>)</span>
                            <a href="javascript:;" class="like">
                                <i class="fa fa-thumbs-up"></i>
                                <span>赞(<%= res.data[i].likes%>)</span>
                            </a>
                            <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
                        </p>
                        <a href="list.php?createdid=<%= res.data[i].id%>;" class="thumb">
                            <img src="./static/uploads/widget_5.jpg" alt="">
                        </a>
                    </div>
                </div>
    <% }%>
    </script>
    <!-- <script src="./static/assets/vendors/jquery/jquery.js"></script> -->
    <script src="./static/assets/vendors/jquery/jquery.min.js"></script>
    <script>
    $(function(){
        var currentPage=1;
     $(".btn").on("click",function(){
        currentPage++;
        //  console.log('hello');
         var what=location.search.split("=")[1];
        //  console.log(what);
         var categoryId=what;
         //ajax发送请求
         $.ajax({
             type:"post",
             url:"api/_getMorePost.php",
             data:{
                 "categoryId":what,
                 "currentPage":currentPage,
                 "pageSize":10
             },
             dataType:"json",
             success:function(res){              
                 var maxPage=Math.ceil(res.countNum/10);              
                //  if(currentPage==maxPage){
                    
                //      $(".box").hide();
                //  }
                if(res.code==0){
                    $(".box").hide();
                    return;
                }
                 console.log(res); 
                // var str1=template("temp",res) ;
                var str1=template("temp",{"res":res}) ;
                $(".box").before(str1);   
                
             }

         })        
     })
    })
    
    </script>
   
</body>

</html>