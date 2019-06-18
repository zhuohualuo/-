<?php
//引入公共文件
require_once "../config.php";
require_once "../function.php";
$email=$_POST["email"];
$password=$_POST["password"];
$sql3="SELECT * FROM users WHERE email='{$email}' and `password`='{$password}' and `status`= 'activated'";
$arr7=query(connect(),$sql3);
// print_r($arr7);
$response=["code"=>0,"msg"=>"输入错误"];
if($arr7){
    session_start();
    $_SESSION["login"]=1;
    $_SESSION["user_id"]=$arr7[0]["id"];
    $response["code"]=1;
    $response["msg"]="输入正确";
}
header("Content-Type:application/json;charset=utf-8");
echo json_encode($response);

?>