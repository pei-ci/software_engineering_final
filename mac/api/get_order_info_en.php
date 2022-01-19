<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Origin, Methods, Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");
require_once('conn.php');
	$result = $conn->query("SELECT *
							FROM `meal`
							WHERE OID={$_GET["OID"]}"); 
	if (!$result) {
		die($conn->error);
	  }
	$data =array();
	$i=0;
	$total_price=0;
	while ($row = $result->fetch_assoc()) {
		$SFID="\"".$row['SFID']."\"";
		$get_food_name = $conn->query("SELECT *
							FROM `singlefood`
							WHERE SFID={$SFID}"); 
		if (!$get_food_name) {die($conn->error);}
		$row_food = $get_food_name->fetch_assoc();
		
		$cus_price=0;
		$get_customer = $conn->query("SELECT * FROM `mealcustomer` WHERE NO={$row['NO']}");
		while ($row_cus = $get_customer->fetch_assoc()){
			$cus_price=$cus_price+$row_cus['Price'];
		}
		
		
		$data[$i] = array ("NO"=>$row['NO'],"SFID"=>$row['SFID'],"name"=>$row_food['EName'],"count"=>$row['Count'],"price"=>($row['Price']+$cus_price)*$row['Count']);
		$total_price=$total_price+($row['Price']+$cus_price)*$row['Count'];
		$i++;
	  }
	  $get_order = $conn->query("SELECT *
							FROM `cusorder`
							WHERE OID={$_GET["OID"]}"); 
	  if (!$get_order) {
		  die($conn->error);
	    }
	  $row_order = $get_order->fetch_assoc();
	  $type_str;
	  if($row_order['Type']==1){ $type_str="Eat In";}
	  else{$type_str="Take Out";}
	  $data[$i] = array ("total"=>$total_price,"type"=>$type_str);
	  echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
