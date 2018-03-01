<?php
		include("connect.php");
		$tableno=$_REQUEST['table_no'];
		//echo $catid;
		$query="SELECT id from order_detail where table_no = ".$tableno." AND status=0 ";
		$r=mysql_query($query,$conn);
		$r=mysql_fetch_assoc($r);
	 $query="SELECT * from orders_items where order_id = ".$r['id']." ";
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
