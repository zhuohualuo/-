<?php
	require_once "../../config.php";
	require_once "../../functions.php";
		
	// 1.0 获取相关参数
	$currentPage = $_POST["currentPage"];
	$pageSize = $_POST["pageSize"];
	$offset = ($currentPage - 1) * $pageSize;

	// 2.0 连接数据库
	$connect = connect();
	$sql = "SELECT c.id,c.author,c.content,c.created,c.`status`,p.title FROM comments c
		LEFT JOIN posts p ON p.id = c.post_id
		LIMIT {$offset}, {$pageSize}";
	$queryResult = query($connect, $sql);

	// 2.1 重新查询总的条数
	$countSql = "SELECT count(*) as count FROM comments";
	$countArr = query($connect, $countSql);
	$count = $countArr[0]["count"];
	$pageCount = ceil($count / $pageSize);

	// 3.0 返回数据
	$response = ["code" => 0, "msg" => "操作失败"];
	if($queryResult) {
		$response["code"] = 1;
		$response["msg"] = "操作成功";
		$response["data"] = $queryResult;	
		$response["pageCount"] = $pageCount;	
	}

	header("Content-Type:application/json");
	echo json_encode($response);
?>