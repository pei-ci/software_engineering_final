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
	  
	$get_CID = $conn->query("SELECT * FROM `combolmeal` WHERE MainID={$_GET['MainID']}");
	$row=$get_CID->fetch_assoc();
	$CID="\"".$row['CID']."\"";
	
	$get_price= $conn->query("SELECT * FROM `singlefood` WHERE SFID={$_GET["MainID"]}");
	if (!$get_price) {
		die($conn->error);
	}
	$row=$get_price->fetch_assoc();
	$main_price=$row['Price'];
	
	$get_price= $conn->query("SELECT * FROM `singlefood` WHERE SFID={$_GET["SideID"]}");
	if (!$get_price) {
		die($conn->error);
	}
	$row=$get_price->fetch_assoc();
	$side_price=$row['Price'];
	
	$get_price= $conn->query("SELECT * FROM `singlefood` WHERE SFID={$_GET["DrinkID"]}");
	if (!$get_price) {
		die($conn->error);
	}
	$row=$get_price->fetch_assoc();
	$drink_price=(string)((int)$row['Price']-38);
	
	
	$NO;
	$seq=1;
	$data =array();
	$i=0;
	$row = $result->fetch_assoc();
	if($row['NO']!=[]){
		$NO=(string)((int)$row['NO']+$seq);
		$NO=str_pad($NO,10,"0",STR_PAD_LEFT);
	}
	else{
		$NO="0000000001";
	}
	$seq++;
	$data[$i] = array ("Name"=>"MainNO","NO"=>$NO,"price"=>$main_price);
	$NO="\"".$NO."\"";
	$i++;
	$write = $conn->query("INSERT INTO `meal` VALUE ({$NO},{$_GET['OID']},{$_GET['MainID']},{$CID},{$_GET['count']},{$main_price})");
	if(!$write)echo "{$write} 語法執行失敗，錯誤訊息: " . $conn->error;
	$NO=(string)((int)$row['NO']+$seq);
	$NO=str_pad($NO,10,"0",STR_PAD_LEFT);
	$data[$i] = array ("Name"=>"SideNO","NO"=>$NO,"price"=>$side_price);
	$NO="\"".$NO."\"";
	$seq++;
	$i++;
	$write = $conn->query("INSERT INTO `meal` VALUE ({$NO},{$_GET['OID']},{$_GET['SideID']},{$CID},{$_GET['count']},{$side_price})");
	if(!$write)echo "{$write} 語法執行失敗，錯誤訊息: " . $conn->error;
	
	$NO=(string)((int)$row['NO']+$seq);
	$NO=str_pad($NO,10,"0",STR_PAD_LEFT);
	$data[$i] = array ("Name"=>"DrinkNO","NO"=>$NO,"price"=>$drink_price);
	$NO="\"".$NO."\"";
	$i++;
	$write = $conn->query("INSERT INTO `meal` VALUE ({$NO},{$_GET['OID']},{$_GET['DrinkID']},{$CID},{$_GET['count']},{$drink_price})");
	if($write)echo json_encode($data,JSON_UNESCAPED_UNICODE);
	else echo "{$write} 語法執行失敗，錯誤訊息: " . $conn->error;
	
?>