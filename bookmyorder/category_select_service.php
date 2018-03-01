<?php
include("connect.php");
		$query="SELECT * from category";
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
