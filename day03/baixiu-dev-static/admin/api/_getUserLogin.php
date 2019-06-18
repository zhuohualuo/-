<?php
	// 1.0 引入公共模块
	require_once "../../config.php";
	require_once "../../functions.php";

	// 2.0 获取相关参数
	$email = $_POST["email"];
	$password = $_POST["password"];

	// 3.0 连接数据库
	$connect = connect();
	$sql = "SELECT * FROM users WHERE email = '{$email}' AND `password` = '{$password}' AND `status` = 'activated'";
	$queryResult = query($connect, $sql);
	pirnt_r($queryResult);

	// 4.0 返回数据
	$response = ["code" => 0, "msg" => "操作失败"];
	if($queryResult) {
		session_start();
		$_SESSION["isLogin"] = 1;
		// 存储用户的id，以便将来获取
      	$_SESSION["user_id"] = $queryResult[0]["id"];

		$response["code"] = 1;
		$response["msg"] = "操作成功";
	}

	header("Content-Type:application/json;charset=utf-8");
	echo json_encode($response);
?>