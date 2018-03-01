<?php
		$conn=mysql_connect("localhost","root","");
		@mysql_select_db("meal");
		$query="SELECT * from orders";
		$row=array();
		$result=mysql_query($query,$conn);
		while($r=mysql_fetch_assoc($result))
		{
			$row[]=$r;
	
			
		}
		echo json_encode($row);

?>
