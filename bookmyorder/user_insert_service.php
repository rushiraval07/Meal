<?php
	$conn=mysql_connect("localhost","root","");
	@mysql_select_db("meal");
	$user=$_REQUEST['username'];
	$password=$_REQUEST['password'];
	$query="INSERT INTO `meal`.`login`(username,password,isactive,isdelete) 
			VALUES ('".$user."','".md5($password)."','1','0')";
	//echo $query;
	$result=mysql_query($query,$conn);
	if($result)
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