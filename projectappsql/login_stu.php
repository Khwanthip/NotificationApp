<?php
header("Access-Control-Allow-Origin: *");
header("constant-type: application/json; charset=UTF-8");

//header("Content-type:application/json",true);
/*$con = @mysqli_connect('localhost', 'root', '', 'projectstudentv2');*/

/*$data = array("data"=>array());
$username = $_GET['username'];
$password = $_GET['password'];*/

include('config.php');

/*$contentdata = file_get_contents("php://input");
$getdata = json_decode($contentdata);
$user = $getdata->user;
$pass1 = $getdata->pass;*/
$member = array("member"=>array());
$user = $_GET['user'];
$pass1 = $_GET['pass'];
$pass = md5($pass1);

$sql = "SELECT
                  project_has_student.phs_project_id, 
                  project.project_name, 
                  project_has_student.phs_key, 
                  student.student_id, 
                  student.student_title,
                  student.student_name,
                  student.student_lastname, 
                  student.student_type, 
                  student.student_password, 
                  student.student_photo, 
                  project.project_status
                FROM
                  student
                 
                  INNER JOIN
                  project_has_student
                  ON 
                    student.student_id = project_has_student.phs_student_id
                  INNER JOIN
                  project
                  ON 
                    project_has_student.phs_project_id = project.project_id
                    Where student_id= '$user' and student_password ='$pass'
                ORDER BY
                  project_has_student.phs_key DESC
                LIMIT 1 ";

$query  = mysqli_query($con, $sql);
$row=mysqli_fetch_assoc($query);
  //ทดสอบผล print_r($row);
  //ดึงข้อมูลมาใส่ในอาร์เรย์
    $member = 
    [
      "student_id" => $row["student_id"],
      "student_title" => $row["student_title"],
      "student_name" => $row["student_name"],      
      "student_lastname" => $row["student_lastname"],
      "phs_project_id" => $row["phs_project_id"],
      "student_type" => $row["student_type"],
      "student_photo" => $row["student_photo"],
      "project_status" => $row["project_status"]
    ];

echo json_encode($member);
?>