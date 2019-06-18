<?php
	// 1.0 获取当前上传进来的文件
	$file = $_FILES["file"];

	// 2.0 随机生成一个名称
	$fileName = time().round(10000, 99999).strrchr($file["name"], ".");

	// 3.0 上传到服务的uploads的文件夹中
	$bool = move_uploaded_file($file["tmp_name"], "../../static/uploads/".$fileName);

	// 4.0 返回给前端路径
	$response = ["code" => 0, "msg" => "操作失败"];
	if($bool) {
      	$response["code"] = 1;
      	$response["msg"] = "操作成功";
      	$response["src"] = '../static/uploads/'.$fileName;
   	}

	header("Content-Type:application/json");
	echo json_encode($response);
?>