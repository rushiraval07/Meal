<?php
		$conn=mysql_connect("localhost","root","");
		@mysql_select_db("meal");
		$tableno=$_REQUEST['table_no'];
		$tablestat=$_REQUEST['table_status'];
		if($tablestat==1)
		{
			$query = "UPDATE `table_list` SET `table_status =0 WHERE table_no=".$tableno."";
			$result=mysql_query($query,$conn);
		}
		else
		{
			$query = "UPDATE `table_list` SET `table_status =1 WHERE table_no=".$tableno."";
			$result=mysql_query($query,$conn);
		}
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