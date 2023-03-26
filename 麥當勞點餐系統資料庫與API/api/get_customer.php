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
			$list=["無糖","微糖","半糖","正常"];
		}
		else if($id=="D003")
		{
			$list=["去冰","微冰","冰塊"];
		}
		else if($id=="A002")
		{
			$list=["蜂蜜芥末醬包","泰式香辣醬包","糖醋醬包","不要醬包"];
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
		$data[$i] = array ("id"=>$row['CUID'],"name"=>$row['Content'],"type"=>$row['Type'],
		"typeName"=>type_name($row['Type']),"defaultNum"=>$row['DefaultNum'],"option"=>default_num($row['CUID'],$row['DefaultNum'],$row['max'],$row['min']));
		$i++;
	  }
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
