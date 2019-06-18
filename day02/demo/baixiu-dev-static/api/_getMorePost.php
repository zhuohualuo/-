<?php
	header("Content-Type:application/json;charset=utf-8");
	require_once "../config.php";
	require_once "../functions.php";
	// 1.0 获取前端请求时传递过来的参数
	$categoryId = $_POST["categoryId"];
	$currentPage = $_POST["currentPage"];
	$currentSize = $_POST["currentSize"];
	// 计算从哪里开始获取数据
	$offset = ($currentPage - 1) * $currentSize;
	
	// 2.0 连接数据库，查询数据
	$connect = connect();
	$sql = "SELECT p.id,p.title,p.created,p.content,p.views,p.likes,p.feature,c.`name`,u.nickname,
            (SELECT count(id) FROM comments WHERE post_id = p.id) as commentsCount
            FROM posts p
            LEFT JOIN users u ON u.id = p.user_id
            LEFT JOIN categories c ON c.id = p.category_id
            WHERE p.category_id = {$categoryId}
            ORDER BY p.created DESC
            LIMIT {$offset},{$currentSize}";
    $postArr = query($connect, $sql);

    // 4.0 增加一条信息，描述总文章数
    $sqlCount = "SELECT count(id) as postCount FROM posts WHERE category_id = {$categoryId}";
    $countArray = query($connect, $sqlCount);
    $pageCount =  $countArray[0]["postCount"];



    // 3.0 返回数据
    $response = ["code" => 0, "msg" => "操作失败"];
    if($postArr) {
    	$response["code"] = 1;
    	$response["msg"] = "操作成功";
        $response["data"] = $postArr;
    	$response["pageCount"] = $pageCount;
    }
    echo json_encode($response);
?>