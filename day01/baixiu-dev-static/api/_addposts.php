<?php
require_once "../config.php";  
require_once "../function.php";  
// print_r($_POST);

//新增语句
$keys=array_keys($_POST);
$values=array_values($_POST);
$sql="insert into posts(".implode(",",$keys).") values('".implode("','",$values)."')";
$connect = connect();
$result = mysqli_query($connect, $sql);

$response = ["code" => 0, "msg" => "操作失败"];
if($result) {
    $response["code"] = 1;
    $response["msg"] = "操作成功";
}

header("Content-Type:application/json");
echo json_encode($response);
?>