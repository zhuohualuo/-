<?php
require_once "../config.php";
require_once "../function.php";
$pageSize=$_POST["pageSize"];
$currentPage=$_POST["currentPage"];
$offset=($currentPage-1)*$pageSize;
$sql="select c.author,c.content,c.status,c.created,p.title from comments c
left join posts p on p.id=c.post_id
limit {$offset},{$pageSize}
";
// echo $sql;
$sqlCount="select count(*) as count from comments";
$countArr=query(connect(),$sqlCount);
$count=$countArr[0]["count"];
$maxPage=ceil($count/$pageSize);
$result=query(connect(),$sql);
$response=["code"=>0,"msg"=>"操作失败"];
if($result){
    $response["code"]=1;
    $response["msg"]="操作成功";
    $response["data"]=$result;
    $response["maxPage"]=$maxPage;
}; 
header("Content_Type:application/json;charset=utf-8");
echo json_encode($response);
?>