<?php
	$conn=mysql_connect("localhost","root","");
	@mysql_select_db("meal");
	$itemname=$_REQUEST['item_name'];
	$itemprice=$_REQUEST['item_price'];
	$itemcontent=$_REQUEST['item_content'];
	$query="INSERT INTO `item_list`(`item_name`, `item_price`, `item_content`) 
			VALUES ('$itemname','$itemprice','$itemcontent')";
	
	$result=mysql_query($query,$conn);
	if($result==1)
	{
		$ack=array("status"=>"1","msg"=>"success");
	}
	else
	{
		$ack=array("status"=>"0","msg"=>"erroe");
	}
	echo json_encode($ack);
?>