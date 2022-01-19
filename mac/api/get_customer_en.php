<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Origin, Methods, Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");
	function type_name($type)
	{
		$type_str;
		if($type) $type_str="boolean";
		else      $type_str="integer";
		return $type_str;
	}
	function default_num($id,$default,$max,$min)
	{
		$list =array();
		if($id=="D002")
		{
			$list=["No Sugar","Light Sugar","Half Sugar","Standard"]; 
		}
		else if($id=="D003")
		{
			$list=["No Ice","Less Ice","Normal"];
		}
		else if($id=="A002")
		{
			$list=["Honey Mustard Sauce","Spicy Buffalo Sauce","Sweet ‘N Sour Sauce","No Suace"];
		}
		else{
			for($j=$min;$j<=$max;$j++)
			{
				$i=$j-$min;
				$list[$j-$min]=(string)$j;
			}
		}
		return $list;
	}
	require_once('conn.php');
	$result = $conn->query("SELECT *
							FROM `customer`
							INNER JOIN singlefoodwithcustomer
							USING (CUID)
							WHERE singlefoodwithcustomer.SFID={$_GET["id"]}"); 
	if (!$result) {
		die($conn->error);
	  }
	$data =array();
	$i=0;
	while ($row = $result->fetch_assoc()) {
		$data[$i] = array ("id"=>$row['CUID'],"name"=>$row['EContent'],"type"=>$row['Type'],
		"typeName"=>type_name($row['Type']),"defaultNum"=>$row['DefaultNum'],"option"=>default_num($row['CUID'],$row['DefaultNum'],$row['max'],$row['min']));
		$i++;
	  }
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
