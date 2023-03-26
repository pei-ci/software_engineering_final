<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Origin, Methods, Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");
	require_once('conn.php');
	$result = $conn->query("SELECT MAX(OID) AS OID
							FROM `cusorder`");
	if (!$result) {
		die($conn->error);
	  }
	$OID;
	$data =array();
	$i=0;
	while ($row = $result->fetch_assoc()) {
		if($row['OID']!=[])
		{
			
			$OID=(string)((int)$row['OID']+1);
			$OID=str_pad($OID,10,"0",STR_PAD_LEFT);
		}
		else
		{
			$OID="0000000001";
		}
		$data[$i] = array ("id"=>$OID);
		$OID="\"".$OID."\"";
		$i++;
	  }
	  date_default_timezone_set('Asia/Taipei');
	  $date    = new DateTime();
	  $stringDate = "\"".$date->format('Y-m-d H:i:s')."\"";
	  $write = $conn->query("INSERT INTO `cusorder` VALUE ({$OID},{$stringDate},{$_GET['table']},{$_GET['type']})");
	  if($write)echo json_encode($data,JSON_UNESCAPED_UNICODE);
	  else echo "{$write} 語法執行失敗，錯誤訊息: " . $conn->error;
?>