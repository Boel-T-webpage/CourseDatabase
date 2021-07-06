<?php

// Check for empty input signup
function emptyInputSignup($fullname, $email, $username, $pwd, $pwdRepeat) {
	$result;
	if (empty($fullname) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function getTag($conn,$userid, $courseid, $tagname) {
	$sql="";
	$id=0;
	if($userid>0) {
		$sql = "SELECT tag_name, tag_value FROM tags WHERE user_id = ? and tag_name = ?;";
		$id=$userid;
	}elseif($courseid>0) {
		$sql = "SELECT tag_name, tag_value FROM tags WHERE course_id = ? and tag_name = ?;";
		$id=$courseid;
	}else {
		throw new Exception("Missing userid or courseid.");
	}

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	throw new Exception("Statement failed.");
	}

	mysqli_stmt_bind_param($stmt, "ds", $id, $tagname);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row["tag_value"];
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}



function saveTag($conn, $userid, $courseid, $tagname, $tagvalue) {
	#echo "<pre>";var_dump($conn);echo "</pre>";
 $sql = "INSERT INTO tags (user_id, course_id, tag_name, tag_value) VALUES (?, ?, ?, ?)";

   $stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);

	mysqli_stmt_bind_param($stmt, "ddss", $userid, $courseid, $tagname, $tagvalue);

	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);

	}


// Check invalid username
function invalidUsername($username) {

	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid email
function invalidEmail($email) {
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check if passwords matches
function pwdMatch($pwd, $pwdrepeat) {
	$result;
	if ($pwd !== $pwdrepeat) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check if input username corresponds to username or email in database, if so then return whole row of user
function uidExists($conn, $username) {
  $sql = "SELECT * FROM users WHERE username = ? OR usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ss", $username, $username);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);
}

// Insert new user into database
function createUser($conn, $fullname, $email, $username, $pwd) {
  $sql = "INSERT INTO users (usersName, usersEmail, username, usersPwd) VALUES (?, ?, ?, ?);";
	//echo "<pre>" ; print_r($pwd);
	//die();
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	//$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
		// her skalvilige se hvad hashedPwd gør
		/*echo "<pre>" ; print_r($username);
		echo "<pre>" ; print_r($uidExists); // hele array = users[row] fremsoegt via uidExists
		echo "<pre>" ; print_r($uidExists["usersPwd"]); // henter brugeres faktiske password fra tabel users  */

	mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $username, $pwd); // $hashedPwd -> $pwd for circumventing the hash
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../signup.php?error=none");
	exit();
}

// Check for empty input login
function emptyInputLogin($username, $pwd) {
	$result;
	if (empty($username) || empty($pwd)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Log user into website
function loginUser($conn, $username, $pwd) {
	$uidExists = uidExists($conn, $username);
	/*echo "<pre>" ; print_r($username);
	echo "<pre>" ; print_r($uidExists); // hele array = users[row] fremsoegt via uidExists
	echo "<pre>" ; print_r($uidExists["usersPwd"]); // henter brugeres faktiske password fra tabel users
	echo "<pre>" ; print_r($pwd);  // det man indtaster i pwd
	die("lige efter udiexistskaldes foerste gang i login user"); */

	if ($uidExists === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $uidExists["usersPwd"]; // creates local var $pwdHashed fra tabelen
	$checkPwd = true; //password_verify($pwd, $pwdHashed);

	/*echo "<pre>" ; print_r($pwd);
	echo "<pre>" ; print_r($pwdHashed);
	echo "<pre>" ; print_r($username);
	echo "<pre>" ; print_r($checkPwd);
	echo "<pre>" ; print_r($username);
	die(); */

	if ($checkPwd === false) {
		header("location: ../login.php?error=wrongpwd");
		exit();
	}
	elseif ($checkPwd === true) {
		session_start();
		$_SESSION["userid"] = $uidExists["usersId"];
		$_SESSION["useruid"] = $uidExists["username"];
		header("location: ../index.php?error=none");
		exit();
	}
}

//    -------- Her er en ny funktion         ---------         //
function createCourse($conn, $c_number, $c_name, $c_start_date, $c_end_date, $c_responsible, $c_credits, $c_type, $c_assessment, $c_dep, $c_exam_dur, $creator, $facs)
{


if(!(int)$c_dep > 0 ){  # Hvis tallet ikke er større end 0, dvs. der står noget tekst
$c_dep = new_dep($conn, $c_dep);  # de her linjer skal kopieres
	//die("opret");
}

if(!(int)$c_type > 0 ){  # Hvis tallet ikke er større end 0, dvs. der står noget tekst
$c_type = new_c_type($conn, $c_type);  # de her linjer skal kopieres
//die("opret");
}

	$sql = "INSERT INTO c (c_number, c_name, c_start_date, c_end_date, c_responsible, c_credits, c_type, c_assessment, c_dep, c_exam_dur, creator) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
//die($sql);
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	die("Fejltype");
	}

	mysqli_stmt_bind_param($stmt, "ssssidiiisi", $c_number, $c_name, $c_start_date, $c_end_date, $c_responsible, $c_credits, $c_type, $c_assessment, $c_dep, $c_exam_dur, $creator);
	echo "<pre>" ; print_r($stmt);

	mysqli_stmt_execute($stmt);
	print_r($facs);
	$c_id = mysqli_insert_id($conn);
	foreach ($facs as $fac_id => $fac_count) {
		add_facility_to_course($conn, $c_id, $fac_id, $fac_count);
	//echo " ID er $fac_id for og count er $fac_count";
	}
	//die();
	mysqli_stmt_close($stmt);
	mysqli_close($conn);

}

//    -------- Her er en ny funktion         ---------         //
function get_c_types($conn) {
	$return = array();
	$sql = "SELECT `c_type_id`,`c_type_name` FROM `c_type` ORDER BY `c_type`.`c_type_name` ASC";
	$m = 	mysqli_query($conn, $sql) OR die(mysql_error());
	while ($r = mysqli_fetch_assoc ($m)){
		$return[] = $r;
		}
		return $return;
	}


//    -------- Her er en ny funktion         ---------         //
	function get_c_dep($conn) {
		$return = array();
		$sql = "SELECT `dep_id`,`dep_name` FROM `dep` ORDER BY `dep_id`,`dep_name` ASC";
		$m = 	mysqli_query($conn, $sql) OR die(mysql_error());
		while ($r = mysqli_fetch_assoc ($m)){
			$return[] = $r;
			}
			return $return;
		}

function dodebug($t) {
	echo "-".$t.-"-";
}

//    -------- Her er en ny funktion         ---------         //
function new_dep($conn, $c_dep) {  # de her linjer skal kopieres
			#echo "<pre>";var_dump($conn);echo "</pre>";
			//die($c_dep);
			$dep_name_exists = get_c_dep_by_name($conn, $c_dep);  //returns dep_id if exists
			var_dump($dep_name_exists);
			//die();
			if($dep_name_exists !== false ){
				return $dep_name_exists;
			}


		 $sql = "INSERT INTO dep (dep_name) VALUES (?)";
		   $stmt = mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt, $sql);

			mysqli_stmt_bind_param($stmt, "s", $c_dep);

			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);

			return mysqli_insert_id($conn);
			//mysqli_close($conn); # de her linjer skal kopieres
			}


//    -------- Her er en ny funktion         ---------         //
			function new_c_type($conn, $c_type) {  # de her linjer skal kopieres
				#echo "<pre>";var_dump($conn);echo "</pre>";
			 $sql = "INSERT INTO c_type (c_type_name) VALUES (?)";
			   $stmt = mysqli_stmt_init($conn);
				mysqli_stmt_prepare($stmt, $sql);

				mysqli_stmt_bind_param($stmt, "s", $c_type);

				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
				return mysqli_insert_id($conn);
				//mysqli_close($conn); # de her linjer skal kopieres
				}


	//    -------- Her er en ny funktion         ---------         //
	function get_c_dep_by_name($conn, $c_dep) {

		$sql = "SELECT `dep_id` FROM `dep` WHERE `dep_name` = ? ";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql);


		mysqli_stmt_bind_param($stmt, "s", $c_dep);
		mysqli_stmt_execute($stmt);


		$resultData = mysqli_stmt_get_result($stmt);

		if ($row = mysqli_fetch_assoc($resultData)) {
			return $row["dep_id"] ;
		}
		return false;

		}

		//    -------- Her er en ny funktion         ---------         //
			function get_fac($conn) {
				$return = array();
				$sql = "SELECT `fac_id`,`fac_name` FROM `fac` ORDER BY `fac_name` ASC";
				$m = 	mysqli_query($conn, $sql) OR die(mysql_error());
				while ($r = mysqli_fetch_assoc ($m)){
					$return[] = $r;
					}
					return $return;
				}


//    -------- Her er en ny funktion         ---------         //
			function add_facility_to_course($conn, $c_id, $fac_id, $fac_count) {  # de her linjer skal kopieres
				#echo "<pre>";var_dump($conn);echo "</pre>";
			 $sql = "INSERT INTO `x_courses_facilities` (`c_id`, `fac_id`, `fac_count`) VALUES (?, ?, ?);";
			 $stmt = mysqli_stmt_init($conn);
				mysqli_stmt_prepare($stmt, $sql);

				mysqli_stmt_bind_param($stmt, "iii", $c_id, $fac_id, $fac_count);

				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
				return mysqli_insert_id($conn);
				//mysqli_close($conn); # de her linjer skal kopieres
				}
