<?php
//连接数据库获取数据
require_once "../config.php";
require_once "../function.php";
//sql语句里面要得到 所有的catagories内容 是一个二维数组
$sql="SELECT * from categories ";
$result=query(connect(),$sql);
// print_r($result);
//得到最终的结果,先默认一个respont
$respont=["code"=>0,"msg"=>"请求失败"];
if($result){
    $respont["code"]=1;
    $respont["msg"]="请求成功";
    $respont["data"]=$result;
}
//设置输出方式为json格式
header("Content-Type:application/json;charset=utf-8");
echo json_encode($respont);

?>