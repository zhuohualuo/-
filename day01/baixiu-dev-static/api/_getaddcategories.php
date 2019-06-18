<?php
//后端接口
require_once "../config.php";
require_once "../function.php";
$name=$_POST["name"];
$sql="select count(*) as count from categories where name='{$name}'";
$result=query(connect(),$sql);
// print_r($result);
//判断是否重复
$number=$result[0]["count"];
// echo $number;
$response=["code"=>0,"msg"=>"操作失败"];
if($number>0){
    $response["msg"]="姓名已存在,请换一个";
}else{
   //新增语句
   $keys=array_keys($_POST);
   $values=array_values($_POST);
   $sql2="insert into categories(".implode(",",$keys).") value('".implode("','",$values)."')";
   $res2=mysqli_query(connect(),$sql2);

//   echo $res2;
   if($res2){
        $response["code"]=1;
        $response["msg"]="操作成功";
   }
}
header("Content-Type:application/json;charset=utf-8");
echo json_encode($response);
?>