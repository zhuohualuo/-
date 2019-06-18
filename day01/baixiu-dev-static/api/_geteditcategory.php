<?php
require_once  "../config.php";
require_once "../function.php";
//连接数据
$id=$_POST["categoryId"];
unset($_POST["categoryId"]);
$sql="update categories set";
foreach($_POST as $key=>$value){
    $sql.=" {$key}='{$value}',";
};
$sql=substr($sql,0,-1);
$sql.=" where id={$id}";

$result=mysqli_query(connect(),$sql);
// var_dump($result);
$response=["code"=>0,"msg"=>"操作失败"];
if($result){
    $response["code"]=1;
    $response["msg"]="操作成功";
    
};
header("Content-Type:application/json;charset=utf-8");
echo json_encode($response);
?>