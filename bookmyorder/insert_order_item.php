<?php
	include("connect.php");
	if(isset($_REQUEST['table_no'])&& isset($_REQUEST['item_id'])&& isset($_REQUEST['item_name'])&& isset($_REQUEST['item_price'])&& isset($_REQUEST['qty']))
	{
	$tableno=$_REQUEST['table_no'];
	$item_id=$_REQUEST['item_id'];
	$item_name=$_REQUEST['item_name'];
	$item_price=$_REQUEST['item_price'];
	$qty=$_REQUEST['qty'];
	
	$qry="SELECT id FROM `order_detail` WHERE table_no='".$tableno."' AND STATUS = 0";
	$order_id=mysql_query($qry,$conn);
	$total_price=$item_price*$qty;
	
	if(mysql_num_rows($order_id)==1)
	{
	$order_id=mysql_fetch_assoc($order_id);
	$order_id=$order_id['id'];
	$query="INSERT INTO `orders_items` (`order_id`,`table_no`, `item_id`, `item_name`, `item_price`, `total_price` , `quantity`)
			VALUES ('".$order_id."','".$tableno."','".$item_id."','".$item_name."','".$item_price."','".$total_price."','".$qty."')";
	
	$order_item_id=mysql_query($query,$conn);
	
		if($order_item_id)
		{
			$update_table_status="UPDATE table_list SET table_status=1 WHERE table_no='".$tableno."'";
				mysql_query($update_table_status,$conn);
		
			$queryadd= "select SUM(total_price) AS grand_total from orders_items where order_id='".$order_id."'";
				$result=mysql_fetch_assoc(mysql_query($queryadd,$conn));
				$grandtotal=$result['grand_total'];
				$queryupdate="UPDATE `order_detail` SET `order_amount`='$grandtotal' WHERE id='".$order_id."'";
				$result=mysql_query($queryupdate,$conn);
				$ack=array("status"=>"1","msg"=>"success","result"=>array("grandtotal"=>$grandtotal));
		}
		else
		{
			
			$ack=array("status"=>"0","msg"=>"error");
		}
	}
	else
	{
		
		$tableno=$_REQUEST['table_no'];
		$userid=$_REQUEST['user_id'];
		
		$query="INSERT INTO `order_detail` (`table_no`, `userid` ,`status`)
				VALUES ('$tableno','$userid',0)";
		
		
		//echo $query;
		$order_id=mysql_query($query,$conn);
		if($order_id)
		{
			$order_id=mysql_insert_id();
			$query="INSERT INTO `orders_items`(`order_id`,`table_no`, `item_id`, `item_name`, `item_price`, `total_price` , `quantity`)
				VALUES ('".$order_id."','".$tableno."','".$item_id."','".$item_name."','".$item_price."','".$total_price."','".$qty."')";
		
			$order_item_id=mysql_query($query,$conn);
		
			if($order_item_id)
			{
				$update_table_status="UPDATE table_list SET table_status=1 WHERE table_no='".$tableno."'";
				mysql_query($update_table_status,$conn);
		
				$queryadd= "select SUM(total_price) AS grand_total from orders_items where order_id='".$order_id."'";
				
				$result=mysql_fetch_assoc(mysql_query($queryadd,$conn));
				$grandtotal=$result['grand_total'];
				$queryupdate="UPDATE `order_detail` SET `order_amount`='$grandtotal' WHERE id='".$order_id."'";
				$result=mysql_query($queryupdate,$conn);
				$ack=array("status"=>"1","msg"=>"success","result"=>array("grandtotal"=>$grandtotal));
				
			}
			else
			{
				$ack=array("status"=>"0","msg"=>"error");
			}
			
		}
		else
		{
			
			$ack=array("status"=>"0","msg"=>"error");
		}
		
	}
	echo json_encode($ack);
	}
	//echo $query;
	
	
		
	
	else
	{
		echo "sd";
		$ack=array("status"=>"0","msg"=>"error");
		echo json_encode($ack);
	}
?>