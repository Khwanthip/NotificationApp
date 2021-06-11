<?php
$host= "localhost";
$username = "root";
$password = "";
$DBname = "projectstudenv3";

// Create connection
$con = @mysqli_connect($host, $username, $password, $DBname);
@mysqli_set_charset($con, 'utf8');

/* // Check connection
if ($conn){
    echo "work";
}
else{
    echo "not work";
} */

?>