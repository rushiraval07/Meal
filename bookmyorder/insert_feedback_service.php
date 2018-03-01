<?php
	$conn=mysql_connect("localhost","root","");
	@mysql_select_db("meal");
	//$ack="error";
	if(isset($_REQUEST['customer_name'])&&isset($_REQUEST['customer_no'])&&isset($_REQUEST['description']))
	{
		$customername=$_REQUEST['customer_name'];
		$customerno=$_REQUEST['customer_no'];
		$desc=$_REQUEST['description'];
		$query="INSERT INTO `feedback`(`customer_name`, `customer_no`, `description`) 
				VALUES ('".$customername."','".$customerno."','".$desc."')";
	
		$result=mysql_query($query,$conn);
		if($result)
		{
			$ack=array("status"=>"1","msg"=>"success");
			echo json_encode($ack);
		}
		else
		{
			$ack=array("status"=>"0","msg"=>"error");
			echo json_encode($ack);
		}
	}
	
?>