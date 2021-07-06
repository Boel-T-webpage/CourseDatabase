<?php
session_start();
if (isset($_POST["submit"])) {
print_r( $_POST);
  $c_number = $_POST["c_number"];
  $c_name = $_POST["c_name"];
  $c_start_date = $_POST["c_start_date"];
  $c_end_date = $_POST["c_end_date"];
  $c_responsible = $_POST["c_responsible"];
  $c_credits = $_POST["c_credits"];
  $c_type = $_POST["c_type"];
  $c_assessment = $_POST["c_assessment"];
  $c_dep = $_POST["c_dep"];
  $c_exam_dur = $_POST["c_exam_dur"];
  $creator =  $_SESSION["userid"];
  $facs = $_POST["facs"];

  //print_r($_SESSION["userid"]);
  //die("hertil");

//createCourse($conn, $c_number, $c_name, $c_start_date, $c_end_date, $c_responsible, $c_credits, $c_type, $c_assessment, $c_dep, $c_exam_dur);



  require_once "dbh.inc.php";
  require_once 'functions.inc.php';
//die($c_dep);

createCourse($conn, $c_number, $c_name, $c_start_date, $c_end_date, $c_responsible, $c_credits, $c_type, $c_assessment, $c_dep, $c_exam_dur, $creator, $facs);

header("location: ../profile.php");

} else {
	header("location: ../profile.php");  //to do fejl error
}
