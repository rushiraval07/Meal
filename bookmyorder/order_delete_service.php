<?php
		$conn=mysql_connect("localhost","root","");
		@mysql_select_db("meal");
		$itemname=$_REQUEST['item_name'];
		$orderid=$_REQUEST['order_id'];
		//echo $catid;
		$query="DELETE FROM `orders_items` WHERE order_id=".$orderid." AND item_id='".$itemname."'";
		//echo $query;
		$row=array();
		$result=mysql_query($query,$conn);
		if($result>0)
		{
			$ack=array("status"=>"1","msg"=>"success");
		}
		else
		{
			$ack=array("status"=>"0","msg"=>"error");
		}
	
	$ack['result']=$row;
	echo json_encode($ack);

?>