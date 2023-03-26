<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Origin, Methods, Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");
require_once('conn.php');
	$result = $conn->query("SELECT *
							FROM `singlefood`
							WHERE SFID={$_GET["id"]}"); 
	if (!$result) {
		die($conn->error);
	  }
	$d=0;
	$one="\"1\"";
	if($_GET["combo"]=="1" or $_GET["combo"]==$one and $_GET["id"]['1']=='D' ){
		$d=38;
	}
	$data =array();
	$i=0;
	while ($row = $result->fetch_assoc()) {
		$data[$i] = array ("id"=>$row['SFID'],"name"=>$row['EName'],"price"=>(string)((int)$row['Price']-$d));
		$i++;
	  }
	  echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
