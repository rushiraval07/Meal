<?php
		include("connect.php");
		$catid=$_REQUEST['cat_id'];
		//echo $catid;
		$query="SELECT * from item_list where cat_id =".$catid."";
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
