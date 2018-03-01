<?php
	$conn=mysql_connect("localhost","root","");
	@mysql_select_db("meal");
	if(isset($_REQUEST['table_no'])&&isset($_REQUEST['user_id'])&&isset($_REQUEST['customer_name'])&&isset($_REQUEST['customer_number'])&&isset($_REQUEST['order_amount']))
	{
	$tableno=$_REQUEST['table_no'];
	$userid=$_REQUEST['user_id'];
	$customername=$_REQUEST['customer_name'];
	$customerno=$_REQUEST['customer_number'];
	$orderamount=$_REQUEST['order_amount'];
	
	$query="INSERT INTO `order_detail`(`table_no`, `userid`, `customer_name`, `customer_number`, `order_amount`)
			VALUES ('$tableno','$userid','$customername','$customerno','$orderamount')";
	
	
	//echo $query;
	$result=mysql_query($query,$conn);
	if($result)
	{
		$ack=array("status"=>"1","msg"=>"success");
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