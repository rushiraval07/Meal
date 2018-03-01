<?php 
include("connect.php");
// Get User ID and Product id 
$table_id=$_REQUEST['table_id'];
$b_name=isset($_REQUEST['b_name'])?$_REQUEST['b_name']:"";
$b_number=isset($_REQUEST['b_number'])?$_REQUEST['b_number']:"";
$b_email=isset($_REQUEST['b_email'])?$_REQUEST['b_email']:"";
$b_address=isset($_REQUEST['b_address'])?$_REQUEST['b_address']:"";
$b_city=isset($_REQUEST['b_city'])?$_REQUEST['b_city']:"";
$b_state=isset($_REQUEST['b_state'])?$_REQUEST['b_state']:"";
$b_country=isset($_REQUEST['b_country'])?$_REQUEST['b_country']:"";
$status=1;
$delivery_date=date("Y-m-d",strtotime("+7 days"));
$shipping_date=date("Y-m-d",strtotime("+7 days"));
$order_date=date("Y-m-d");

$sql= "SELECT * FROM `order_detail`  WHERE `table_no`='".$table_id."' AND status=0";	
// Whether cart with status 0 available or not
$resource_cart_check=mysql_query($sql,$conn);
if(mysql_num_rows($resource_cart_check)>=1)
{
	$data_cart=mysql_fetch_assoc($resource_cart_check);
	$cart_id=$data_cart['id'];
	//echo "UPDATE `order_detail` SET `b_name`='".$b_name."',`b_number`='".$b_number."',`b_email`='".$b_email."',`b_address`='".$b_address."',`b_city`='".$b_city."',`b_state`='".$b_state."',`b_country`='".$b_country."',`status`='".$status."' WHERE `id`='".$cart_id."'";
	$q=mysql_query("UPDATE `order_detail` SET `b_name`='".$b_name."',`b_number`='".$b_number."',`b_email`='".$b_email."',`b_address`='".$b_address."',`b_city`='".$b_city."',`b_state`='".$b_state."',`b_country`='".$b_country."',`status`='".$status."' WHERE `id`='".$cart_id."'",$conn);

if($q)
	{
		$update_table_status="UPDATE table_list SET table_status=0 WHERE table_no='".$table_id."'";
				mysql_query($update_table_status,$conn);
				
		$result=array("status"=>1,"msg"=>"success");
		echo json_encode($result);
	}
	else
	{
		$result=array("status"=>0,"msg"=>"ERROR");
		echo json_encode($result);
	}
}
else
{
	$result=array("status"=>0,"msg"=>"ERROR");
		echo json_encode($result);
}

?>