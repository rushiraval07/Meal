<?php
		$table_id=$_REQUEST['table_id'];
		$conn=mysql_connect("localhost","root","");
		@mysql_select_db("meal");
		$tableid=$_REQUEST['table_is'];
		$id=$_REQUEST['order_id'];
		$query="SELECT * from order_detail where table_no='".$tableid."'AND id='".$id."'";
		$row=array();
		$result=mysql_query($query,$conn);
		while($r=mysql_fetch_assoc($result))
		{
			$row[]=$r;
	
			
		}
		echo json_encode($row);

?>
