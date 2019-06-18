<?php
//创建连接数据库文件
function connect (){
    return mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);
}
//获取数据
function query($conn,$sql){
    $data= mysqli_query($conn,$sql);
    return fetch($data);
}
//取得二维数组
function fetch($res){
    $arr=[];
    while($row=mysqli_fetch_assoc($res)){
        $arr[]=$row;
    }
    return $arr;
}
//验证登录成功
function checkLogin(){
    session_start();
    if(!isset($_SESSION["login"])||$_SESSION["login"]!=1){
        header("location:login.php");
    }
}
?>