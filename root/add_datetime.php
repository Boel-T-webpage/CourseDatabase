<?php

//include "db_connect.php";

// 4 variables to connnect to database
$host = "localhost";
$username = "root";
$user_pass = "";
$database_in_use = "test";

// create a database connection insntance
$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);

$newfirst_meeting = $_POST["fm"];

$newfirst_meeting = addslashes($newfirst_meeting);


//Stating what we are trying to do
echo"<h2>Trying to add a new date: $newfirst_meeting . </h2>";



$sql = "INSERT INTO dates (back_id, fm, created_at )
VALUES ( NULL, '$newfirst_meeting'  ,CURRENT_TIMESTAMP ) " ;


/*die($sql);

$sqli = "CREATE TABLE IF NOT EXISTS dates (
    back_id INT AUTO_INCREMENT PRIMARY KEY,
    fm datetime,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)  ENGINE=INNODB";
*/

$result = $mysqli->query($sql) or die(mysqli_error(mysqli));



$sqls = "SELECT back_id, fm, created_at FROM dates";
$resultss = $mysqli->query($sqls);

if ($resultss->num_rows > 0) {
  // output data of each row
  while($row = $resultss->fetch_assoc()) {
    echo "FM dates: " . $row["fm"]. " - created at: " . $row["created_at"].  "<br>";
  }
} else {
  echo "0 results";
}






?>
<a href="index.php">Return to main page </a >
