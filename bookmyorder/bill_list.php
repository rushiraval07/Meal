<?php
		include("connect.php");
		$qury_order_detail="SELECT * from `order_detail` WHERE status=1 ORDER BY id DESC ";
		$result_order_r=mysql_query($qury_order_detail,$conn);
		if(mysql_num_rows($result_order_r)>=1)
		{
			$row=array();
		while($result_order=mysql_fetch_assoc($result_order_r))
	{
			$result_order['order_flag']=1;
			$result_order['order_id']=$result_order['id'];
			$result_order['b_name']=$result_order['b_name'];
			$result_order['amount']=$result_order['order_amount'];
			$result_order['table_id']=$result_order['table_no'];
			$result_order['order_status_slug']=$result_order['status'];
			$result_order['order_status']=($result_order['status']==0)?"In Progress":"Completed";
			$result_order['adate']=date("d M H:i",strtotime($result_order['adate']));
		
		$row[]=$result_order;
		
	}
	
	$ack['status']=1;
	$ack['msg']="fetched";
	$ack['result']=$row;
	echo json_encode($ack);
		}
		else
		{
			$ack['status']=0;
	$ack['msg']="No Orders";
	echo json_encode($ack);	
		}
?>
