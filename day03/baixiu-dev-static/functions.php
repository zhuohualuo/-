<?php
	// 连接数据库
	function connect() {
		return mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
	}
	// 查询sql语句
	function query($connect, $sql) {
		$data = mysqli_query($connect, $sql);
		return fetch($data);
	}
	// 处理数据集
	function fetch($result) {
		$arr = [];
		while($row = mysqli_fetch_assoc($result)) {
			$arr[] = $row;
		}
		return $arr;
	}

	// 验证登录的跳转
	function checkLogin() {
		session_start();
	    if(!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"] != 1) {
	        header("Location: login.php");
	    }
	}
?>