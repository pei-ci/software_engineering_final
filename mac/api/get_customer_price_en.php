<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Origin, Methods, Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");
	require_once('conn.php');
	$result = $conn->query("SELECT *
							FROM `customer`
							WHERE CUID={$_GET["id"]}"); 
	if (!$result) {
		die($conn->error);
	  }
	$data =array();
	$i=0;
	$cus_price=0;
	while ($row = $result->fetch_assoc()) {
		$d=trim($_GET["set_num"],"\"\'")-(int)$row['DefaultNum'];
		{
			$cus_price=(int)$d*(int)$row['Price'];
		}
		$data[$i] = array ("id"=>$row['CUID'],"name"=>$row['EContent'],"price"=>$cus_price);
		$i++;
	  }
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
