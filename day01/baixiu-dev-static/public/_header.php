<?php
//连接数据库
$conn=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);
// $conn=mysqli_connect("localhost","root","root","baixiu");
$sql="select * from categories where id!=1";
$res=mysqli_query($conn,$sql);
// print_r($res);
// $arr=[];
while($row=mysqli_fetch_assoc($res)){
    $arr[]=$row;
};
// print_r($arr);
?>

<div class="header">
            <h1 class="logo">
                <a href="index.html"><img src="static/assets/img/logo.png" alt=""></a>
            </h1>
            <ul class="nav">
                <!-- <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
                <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
                <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
                <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li> -->
                <?php
                foreach($arr as $k=>$val){
                ?>
                <li><a href="list.php?categoryId=<?php echo $val["id"];?>"><i class="fa <?php echo $val["classname"]?>"></i>
                <?php echo $val["name"] ?></a></li>
               
                
               <?php } ?>
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