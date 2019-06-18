<?php
//前段上传回来的数据
// print_r($_POST);
// $file=$_FILES["file"];
//生成一个随机的文件名
// print_r($_FILES);
$fileName=time().rand(100,999).strrchr($_FILES["file"]["name"],".");
//把文件保存在指定的目录里面
$bool=move_uploaded_file($_FILES["file"]["tmp_name"],"../static/uploads/".$fileName);
$response=["code"=>0,"msg"=>"操作失败"];
if($bool){
    $response["code"]=1;
    $response["msg"]="操作成功";
    $response["src"]="../static/uploads/".$fileName;
};
header("Content_Type:application/json;charset=utf-8");
echo json_encode($response);
?>