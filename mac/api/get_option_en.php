<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Origin, Methods, Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");
require_once('conn.php');
	$result = $conn->query("SELECT *
							FROM `option`
							INNER JOIN optionwithfoodtype
							USING (OPID)
							WHERE optionwithfoodtype.TypeID={$_GET["id"]}"); 
	if (!$result) {
		die($conn->error);
	  }
	$data =array();
	$i=0;
	while ($row = $result->fetch_assoc()) {
		$data[$i] = array ("id"=>$row['OPID'],"name"=>$row['EOPName'],"img"=>$row['Imag'],"avaliable"=>$row['avalible']);
		$i++;
	  }
	  echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
