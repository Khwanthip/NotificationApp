<?php
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json",true);

include('config.php');

$listday = array("listday"=>array());

$teacher_id = $_GET['teacher_id'];
//$getproject_id = $getdata->projectdata;

$sql = " SELECT
	project_has_student.phs_project_id, 
	project.project_name, 
	student.student_id, 
	student.student_title, 
	student.student_name, 
	student.student_lastname, 
	project.project_status, 
	appoint.appoint_date_start, 
	appoint.appoint_date_end, 
	appoint.appoint_comment, 
	appoint.appoint_status, 
	appoint.teacher_id, 
	teacher.teacher_id, 
	appoint.recorder
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
	INNER JOIN
	appoint
	ON 
		project.project_id = appoint.project_id AND
		student.student_id = appoint.recorder
	INNER JOIN
	teacher
	ON 
		appoint.teacher_id = teacher.teacher_id
WHERE
	appoint.teacher_id = '$teacher_id' ";

$query 	= mysqli_query($con,$sql);
while($row=mysqli_fetch_assoc($query)){


		array_push($listday["listday"],array(
			"student_title" => $row["student_title"],
      		"student_name" => $row["student_name"],
			"student_lastname" => $row["student_lastname"],
			"project_name" => $row["project_name"],
			"appoint_date_start" => $row["appoint_date_start"],
			"student_id" => $row["student_id"],
			"appoint_comment" => $row["appoint_comment"]
		));

	}

echo json_encode($listday);
?>