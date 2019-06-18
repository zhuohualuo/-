<?php
  	require_once "../../config.php";
	require_once "../../functions.php";
	// 获取用户的头像和昵称，返回给前端动态生成
  	session_start();
	
	$userId = $_SESSION["user_id"];

	// 根据用户的id，到数据库中查询用户的头像和昵称
	$connect = connect();
	$sql = "SELECT * FORM users WHERE id = {$userId}";
	$queryResult = query($connect, $sql);

	$response = ["code" => 0, "msg" => "操作失败"];
	if($queryResult) {
      	$response["code"] = 1;
      	$response["msg"] = "操作成功";
      	$response["avatar"] = $queryResult[0]["avatar"];
     	$response["nickname"] = $queryResult[0]["nickname"];
	}

	header("Content-Type:application/json;chartset=utf-8");
	echo json_encode($response);
?>