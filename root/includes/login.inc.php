<?php

if (isset($_POST["submit"])) {

  // First we get the form data from the URL
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];

  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  // Left inputs empty
  if (emptyInputLogin($username, $pwd) === true) {
    header("location: ../login.php?error=emptyinput");
		exit();
  }

  // If we get to here, it means there are no user errors

  /*echo "<pre>" ; print_r($pwd);
  echo "<pre>" ; print_r($username);
  die();  */ 


  loginUser($conn, $username, $pwd);

} else {
	header("location: ../login.php");
    exit();
}
