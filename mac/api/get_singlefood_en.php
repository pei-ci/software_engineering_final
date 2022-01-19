<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Origin, Methods, Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");
require_once('conn.php');
	$result = $conn->query("SELECT *
							FROM `singlefood`
							INNER JOIN singlefoodwithoption
							USING (SFID)
							WHERE singlefoodwithoption.OPID={$_GET["id"]}"); 
	if (!$result) {
		die($conn->error);
	  }
	$get_img = $conn->query("SELECT *
	FROM `option`
	WHERE OPID={$_GET["id"]}"); 
	if (!$get_img) {
		die($conn->error);
	  }
$row_img = $get_img->fetch_assoc();
$img=$row_img['Imag'];

	$data =array();
	$i=0;
	while ($row = $result->fetch_assoc()) {
		$data[$i] = array ("id"=>$row['SFID'],"name"=>$row['EName'],"price"=>$row['Price'],"img"=>$img);
		$i++;
	  }
	  echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>

