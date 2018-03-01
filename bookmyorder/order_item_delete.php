<?php
	include("connect.php");
	if(isset($_REQUEST['item_id']) && isset($_REQUEST['order_id']))
	{
	$orderid=$_REQUEST['order_id'];
	$id=$_REQUEST['item_id'];
	
	$query="DELETE FROM `orders_items` WHERE id='".$id."'";
	
	
	
	//echo $query;
	$result=mysql_query($query,$conn);
	if($result)
	{
		$queryadd= "select SUM(total_price) AS grand_total from orders_items where order_id='".$orderid."'";
		$result=mysql_fetch_assoc(mysql_query($queryadd,$conn));
		$grandtotal=$result['grand_total'];
		$queryupdate="UPDATE `order_detail` SET `order_amount`='$grandtotal' WHERE id='".$orderid."'";
		$result=mysql_query($queryupdate,$conn);
		$ack=array("status"=>"1","msg"=>"success","grandtotal"=>$grandtotal);
	}
	else
	{
		$ack=array("status"=>"0","msg"=>"error");
	}
	echo json_encode($ack);
	}
	else
	{
		$ack=array("status"=>"0","msg"=>"error");
		echo json_encode($ack);
	}
?>