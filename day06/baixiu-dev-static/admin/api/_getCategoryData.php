<?php
	require_once "../../config.php";
	require_once "../../functions.php";

	$connect = connect();
	$sql = "SELECT * FROM categories";
	$queryResult = query($connect, $sql);

	$response = ["code" => 0, "msg" => "操作失败"];
	if($queryResult) {
		$response["code"] = 1;
		$response["msg"] = "操作成功";
		// 在返回的数组中添加请求到的数据
		$response["data"] = $queryResult;
	}

	header("Content-Type:application/json");
	echo json_encode($response);
?>