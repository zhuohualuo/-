<?php
//连接数据库
require_once "../config.php";
require_once "../function.php";
$id=$_POST["id"];
$sql="delete from categories where id='{$id}'";
$result=mysqli_query(connect(),$sql);
$response=["code"=>0,"msg"=>"操作失败"];
if($result){
    $response["code"]=1;
    $response["msg"]="操作成功";
}
header("Content-Type:application;charset=utf-8");
echo json_encode($response);
?>