<?php
		include("connect.php");
		$query="SELECT * from table_list";
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
		$qury_order_detail="SELECT * from order_detail WHERE table_no='".$r['table_id']."' ORDER BY id DESC LIMIT 1";
		$result_order=mysql_query($qury_order_detail,$conn);
		if(mysql_num_rows($result_order)>=1)
		{
			
			$result_order=mysql_fetch_assoc($result_order);
			$r['order_flag']=1;
			$r['order_id']=$result_order['id'];
			$r['user_id']=$result_order['user_id'];
			$r['order_amount']=$result_order['order_amount'];
			$r['order_status_slug']=$result_order['status'];
			$r['order_status']=($result_order['status']==0)?"In Progress":"Completed";			
			$r['adate']=date("d M H:i",strtotime($result_order['adate']));
		}
		else
		{
			$r['order_flag']=0;
			$r['order_id']="";
			$r['user_id']="";
			$r['order_amount']="";
			$r['order_status_slug']="";
			$r['order_status']="";
			$r['adate']="";
		}
		
		$row[]=$r;
		
	}
	
	$ack['result']=$row;
	echo json_encode($ack);
?>
