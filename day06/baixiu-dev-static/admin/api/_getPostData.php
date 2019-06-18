<?php
	require_once "../../config.php";
	require_once "../../functions.php";

	// 1.0 获取相关参数
	$currentPage = $_POST["currentPage"];
	$pageSize = $_POST["pageSize"];
	$offset = ($currentPage - 1) * $pageSize;
	// 接收状态
	$where = " WHERE 1 = 1 ";
	$status = $_POST["status"];
	if($status != "all") {
		$where .= " AND p.`status` = '{$status}' ";
	}
	$categoryId = $_POST["categoryId"];
	if($categoryId != "all") {
		$where .= " AND p.category_id = '{$categoryId}' ";
	}

	// 2.0 连接数据库
	$connect = connect();
	$sql = "SELECT p.id,p.title,p.`status`,p.created,u.nickname,c.`name` FROM posts p
			LEFT JOIN users u ON u.id = p.user_id
			LEFT JOIN categories c ON c.id = p.category_id ".$where. 
			" LIMIT {$offset},{$pageSize}";
	$queryResult = query($connect, $sql);

	// 2.1 新的一轮查询
	$countSql = "SELECT count(id) as count FROM posts";
	$queryArr = query($connect, $countSql);
	$countPage = $queryArr[0]["count"];
	$maxCount = ceil($countPage / $pageSize);

	// 3.0 返回数据
	$response = ["code" => 0, "msg" => "操作失败"];
	if($queryResult) {
		$response["code"] = 1;
		$response["msg"] = "操作成功";
		$response["data"] = $queryResult;
		$response["maxCount"] = $maxCount;
	}

	header("Content-Type:application/json");
	echo json_encode($response);
?>