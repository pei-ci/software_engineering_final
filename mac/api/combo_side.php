<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Origin, Methods, Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");
require_once('conn.php');
	$result = $conn->query("SELECT * FROM `singlefoodwithoption` INNER JOIN `singlefood` USING (SFID) WHERE OPID = '000' AND SFID LIKE 'S2%'"); 
	if (!$result) {
		die($conn->error);
	  }
	$cus=array(
	"S20001"=>array(array("雞塊","A00015"),array("薯條","A00009")),
	"S20002"=>array(array("原味雞腿","M00013"),array("薯條","A00009")),
	"S20003"=>array(array("辣味雞腿","M00014"),array("薯條","A00009")),
	"S20004"=>array(array("薯條","A00009")),
	"S20005"=>array(array("薯條","A00010")),
	"S20006"=>array(array("沙拉","S20006")),
	"S20007"=>array(array("雞塊","A00015"))
	);
	$data =array();
	$i=0;
	while ($row = $result->fetch_assoc()) {
		$data[$i] = array ("FoodID"=>$row['SFID'], "name"=>$row['Name'], "price"=>$row['Price'], "img"=>$row['img'],"sub_id_list"=>$cus[$row['SFID']]);
		$i++;
	  }
	  echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
