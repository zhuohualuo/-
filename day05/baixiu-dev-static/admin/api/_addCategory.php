<?php
	require_once "../../config.php";
	require_once "../../functions.php";

	// 1.0 获取相关参数
	$name = $_POST["name"];

	// 2.0 连接数据库
	$connect = connect();
	// 2.1 查询分类名称是否存在
	$sql = "SELECT count(*) as count FROM categories WHERE `name` = '{$name}'";
	$queryResult = query($connect, $sql);
	// 2.2 获取重复的条数
	$count = $queryResult[0]["count"];
	

	// 3.0 返回用户数据
	$response = ["code" => 0, "msg" => "操作失败"];
	if($count > 0) {
		// 3.1 当前名称已经重复了
		$response["msg"] = "分类名称已经存在了，换一个吧~";
	} else {
		// 3.2如果没有重复则需要新的查询语句增加
		/*$keys = array_keys($_POST);
		$values = array_values($_POST);

		$addSql = "INSERT INTO categories (". implode(",", $keys) .") VALUES ('". implode("','", $values) ."')";
		$addResult = mysqli_query($connect, $addSql);*/
		$addResult = insert($connect, "categories", $_POST);

		if($addResult) {
			$response["code"] = 1;
			$response["msg"] = "操作成功";
		}
	}

	header("Content-Type:application/json;charset=utf-8");
	echo json_encode($response);
?>