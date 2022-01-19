<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Origin, Methods, Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");
	require_once('conn.php');
	$result = $conn->query("SELECT MAX(NO) AS NO FROM `meal`");
	if (!$result) {
		die($conn->error);
	  }
	
	$get_price= $conn->query("SELECT * FROM `singlefood` WHERE SFID={$_GET["SFID"]}");
	if (!$get_price) {
		die($conn->error);
	}
	$row=$get_price->fetch_assoc();
	$price=$row['Price'];
	
	$NO;
	$data =array();
	$i=0;
	while ($row = $result->fetch_assoc()) {
		if($row['NO']!=[])
		{
			$NO=(string)((int)$row['NO']+1);
			$NO=str_pad($NO,10,"0",STR_PAD_LEFT);
		}
		else
		{
			$NO="0000000001";
		}
		$data[$i] = array ("NO"=>$NO,"price"=>$price);
		$NO="\"".$NO."\"";
		$i++;
	  }
	  $write = $conn->query("INSERT INTO `meal` VALUE ({$NO},{$_GET['OID']},{$_GET['SFID']},NULL,{$_GET['count']},{$price})");
	  if($write)echo json_encode($data,JSON_UNESCAPED_UNICODE);
	  else echo "{$write} 語法執行失敗，錯誤訊息: " . $conn->error;
?>