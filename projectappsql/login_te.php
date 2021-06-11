<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json",true);

include('config.php');


//mysqli_connect("localhost","root","");
//mysqli_select_db("shop");
//mysqli_query("SET NAMES 'utf8'");

$member = array("member"=>array());
//$query = mysqli_query("SELECT * FROM game");
$user = $_GET['user'];
$pass1 = $_GET['pass'];
$pass = md5($pass1);



$sql = "SELECT * FROM teacher WHERE teacher_id='$user' AND teacher_password='$pass'";
$query 	= mysqli_query($con, $sql);
$row=mysqli_fetch_assoc($query);
	//ทดสอบผล print_r($row);
	//ดึงข้อมูลมาใส่ในอาร์เรย์
		$member = 
		[
			"teacher_id" => $row["teacher_id"],
	        "teacher_title" => $row["teacher_title"],
	        "teacher_name" => $row["teacher_name"],      
			"teacher_lastname" => $row["teacher_lastname"],
			"teacher_password" => $row["teacher_password"],
	        "teacher_photo" => $row["teacher_photo"],
	        "teacher_email" => $row["teacher_email"]
		];

echo json_encode($member);
?>