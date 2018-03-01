<?php
 //Rushi Raval Key: 1224
 if($_SERVER['REQUEST_METHOD']=='POST'){
 
 $image = $_POST['image'];
 
 require_once('dbConnect.php');
 
 $sql ="SELECT id FROM photos ORDER BY id ASC";
 
 $res = mysql_query($con,$sql);
 
 $id = 0;
 
 while($row = mysqli_fetch_array($res)){
 $id = $row['id'];
 }
 //TAKE ur image path here
 $path = "uploads/$id.png";
 //static address which never change
 $actualpath = "http://24.24.24.234:8080/PhotoUpload/".$path."";
 
 $sql = "INSERT INTO photos (image) VALUES ('$actualpath')";
 
 if(mysqli_query($con,$sql)){
 file_put_contents($path,base64_decode($image));
 echo "Successfully Uploaded";
 }
 
 mysqli_close($con);
 }else{
 echo "Error";
 }