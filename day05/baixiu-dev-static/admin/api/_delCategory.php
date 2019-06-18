<?php
	require_once "../../config.php";
	require_once "../../functions.php";

	// 获取相关参数
	$id = $_POST["id"];

	// 连接数据库
	$connect = connect();
	$sql = "DELETE FROM categories WHERE id = '{$id}'";
	$result = mysqli_query($connect, $sql);

	$response = ["code" => 0, "msg" => "操作失败"];
	if($result) {
		$response["code"] = 1;
		$response["msg"] = "操作成功";
	}

	header("content-type:application/json");
	echo json_encode($response);
?>