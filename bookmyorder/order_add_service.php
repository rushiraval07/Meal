<?php
	$conn=mysql_connect("localhost","root","");
	@mysql_select_db("meal");
	if(isset($_REQUEST['table_no'])&&isset($_REQUEST['item_id'])&&isset($_REQUEST['item_name'])&&isset($_REQUEST['item_price'])&&isset($_REQUEST['qty']))
	{
	$tableno=$_REQUEST['table_no'];
	$itemid=$_REQUEST['item_id'];
	$itemname=$_REQUEST['item_name'];
	$itemprice=$_REQUEST['item_price'];
	$dateqry="SELECT CURDATE()";
	$quantity=$_REQUEST['quantity'];
	$remarks=$_REQUEST['remarks'];
	$totalprice=$itemprice*$quantity;
	
	echo $query="INSERT INTO `orders_items`(`order_id`, `table_no`, `item_id`, `item_name`, `item_price`,`total_price`, `quantity`, `remarks`) 
			VALUES ('$orderid','$tableno','$itemid','$itemname','$itemprice','$totalprice','$quantity','$remarks')";
	
	
	
	//echo $query;
	$result=mysql_query($query,$conn);
	if($result)
	{
		$queryadd= "select SUM(total_price) AS grand_total from orders_items where order_id='".$orderid."'";
		$result=mysql_fetch_assoc(mysql_query($queryadd,$conn));
		$grandtotal=$result['grand_total'];
		$queryupdate="UPDATE `order_detail` SET `order_amount`='$grandtotal' WHERE id='".$orderid."'";
		$result=mysql_query($queryupdate,$conn);
		$ack=array("status"=>"1","msg"=>"success","result"=>array("grandtotal"=>$grandtotal));
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