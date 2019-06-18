<?php
require "../config.php";
require "../function.php";
$categoryId=$_POST["categoryId"];
$pageSize=$_POST["pageSize"];
$currentPage=$_POST["currentPage"];
$offset=($currentPage-1)*$pageSize;
$sql="SELECT p.id,p.title,p.created,p.content,p.views,p.likes,p.feature,u.nickname,c.`name`,
(SELECT count(id) FROM comments WHERE comments.post_id = p.id) as commentCount
FROM posts p
LEFT JOIN users u ON u.id = p.user_id
LEFT JOIN categories c ON c.id = p.category_id
WHERE p.category_id = {$categoryId}
LIMIT {$offset},{$pageSize}";
$arr4=query(connect(),$sql);
// //获取最大值的查询语句
$sql2="SELECT count(id) as allpost FROM posts  WHERE category_id={$categoryId} ";
// SELECT count(id) as postCount FROM posts WHERE category_id = {$categoryId}"
$arr5=query(connect(),$sql2);
// print_r($arr5);
$countNum=$arr5[0]["allpost"];
//返回给前端,默认写入数据
$respont=["code"=>0,"msg"=>"操作失败"];
// prin_r($respont);
// if($respont){
// // print_r($respont);
//     $respont["code"]=1;
//     $respont["msg"]="操作成功";
//     $respont["data"]=$arr4;
//     $respont["countNum"]=$countNum;
// };
if($arr4){
    $respont=["code"=>1,"msg"=>"操作成功","data"=>$arr4,"countNum"=>$countNum];
}

header("Content-Type:application/json;chartset=utf-8");
 echo json_encode($respont);
?>