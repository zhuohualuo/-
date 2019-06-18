<?php require_once "../config.php";
 require_once "../function.php";
//查询语句
//获取前端两个数据


$sql="SELECT p.id,p.title,p.created,p.`status`,u.nickname,c.name from posts p
LEFT JOIN users u ON u.id = p.user_id
LEFT JOIN categories c ON c.id = p.category_id
";


$queryResult=query(connect(),$sql);
$respont=["code"=>0,"msg"=>"错误"];
if($queryResult){
    $respont["code"]=1;
    $respont["msg"]="正确";
    $respont["data"]=$queryResult;

};
header("Content-Type:application/json;charset=uft-8");
echo json_encode($respont);
?>
