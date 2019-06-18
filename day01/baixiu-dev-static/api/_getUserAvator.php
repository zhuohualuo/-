<?php require_once "../config.php";
 require_once "../function.php";

session_start();
$user_id=$_SESSION["user_id"];
//查询语句
$sql="select * from users where id={$user_id}";
$queryResult=query(connect(),$sql);
$respont=["code"=>0,"msg"=>"错误"];
if($queryResult){
    $respont["code"]=1;
    $respont["msg"]="正确";
    $respont["avatar"]=$queryResult[0]["avatar"];
    $respont["nickname"]=$queryResult[0]["nickname"];

};
header("Content-Type:application/json;charset=uft-8");
echo json_encode($respont);
?>
