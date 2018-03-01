<?php
	$conn=mysql_connect("localhost","root","");
	@mysql_select_db("meal");
	$tableno=$_REQUEST['table_no'];
	$itemname=$_REQUEST['item_name'];
	$itemprice=$_REQUEST['item_price'];
	$dateqry="SELECT CURDATE()";
	$timeqry="SELECT CURTIME()";
	$date1=date("Y-m-d",time());
	
	$time1=date("H:i:s",time());
	$query="INSERT INTO `meal`.`orders`(table_no,item_name,item_price,order_date,order_time) 
			VALUES ('$tableno','$itemname','$itemprice','$date1','$time1')";
	
	
	//echo $query;
	$result=mysql_query($query,$conn);
	if($result)
	{
	
		$query="UPDATE `table_list` SET table_status=1 WHERE table_id='".$tableno."'";
		$result=mysql_query($query,$conn);
		$ack=array("status"=>"1","msg"=>"success");
	}
	else
	{
		$ack=array("status"=>"0","msg"=>"error");
	}
	echo json_encode($ack);
?>