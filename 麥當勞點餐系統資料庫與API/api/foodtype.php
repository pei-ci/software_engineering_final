<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Origin, Methods, Content-Type, Authorization,cache-control,x-requested-with");
header("Content-Type: application/json; charset=UTF-8");
require_once('conn.php');
	$result = $conn->query("SELECT * FROM foodtype WHERE TypeID!='ES'"); 
	if (!$result) {
		die($conn->error);
	  }
	$data =array();
	$i=0;
	while ($row = $result->fetch_assoc()) {
		$data[$i] = array ("id"=>$row['TypeID'],"name"=>$row['Type'],"img"=>$row['Img']);
		$i++;
	  }
	  echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
