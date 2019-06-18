<?php
	require_once "../../config.php";
	require_once "../../functions.php";

	// 获取相关参数
	$ids = $_POST["ids"];

	// 连接数据库
	$connect = connect();
	// [1, 2, 4, 6, 7]    '1','2','4','6','7'
	$sql = "DELETE FROM categories WHERE id in ('". implode("','", $ids) ."')";
	$result = mysqli_query($connect, $sql);

	$response = ["code" => 0, "msg" => "操作失败"];
	if($result) {
		$response["code"] = 1;
		$response["msg"] = "操作成功";
	}

	header("content-type:application/json");
	echo json_encode($response);
?>