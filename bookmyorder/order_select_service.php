<?php
		$conn=mysql_connect("localhost","root","");
		@mysql_select_db("meal");
		$orderid=$_REQUEST['order_id'];
		$tableno=$_REQUEST['table_no'];
		//echo $catid;
		$query="SELECT * from orders_items where order_id=".$orderid."";
		//echo $query;
		$row=array();
		$result=mysql_query($query,$conn);
		if(mysql_num_rows($result)>0)
		{
			$ack=array("status"=>"1","msg"=>"success");
		}
		else
		{
			$ack=array("status"=>"0","msg"=>"error");
		}
		while($r=mysql_fetch_assoc($result))
	{
		$row[]=$r;
	}
	
	$ack['result']=$row;
	echo json_encode($ack);

?>