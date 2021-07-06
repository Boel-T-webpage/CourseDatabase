<html>
<p>  tekst </p>

</html>

<?php
ini_set("display_errors",1);
//require_once 'functions.inc.php';
//include 'functions.inc.php';


$usernamess = 'za00p' ;

$result = 2;

echo $result ;
echo "<br>";
if (!preg_match("/^[a-zA-Z0-9]*$/", $usernamess)) {
		$result = true;
	}
else {
		$result = false;
	}

echo "<br>";
echo "efter testen ::    ". $result ;
echo "<br>";
echo "resultatet af invaduid var:  ".  $result ;
echo "<br> mere her kommer endelige resultat :    :    ";
echo $result ;
echo "<br> mere her kommer endelige resultat";


/*

$somestring = "Thomas har vist lavet meget i dag";


//$tester = (!preg_match("/^[a-zA-Z0-9]*$/", $usernamess));
//$tester = (preg_match("/^[a-zA-Z0-9]*$/", $usernamess));
//preg_match("/Thomas/" , $somestring);
$testpreg = preg_match("/Thomas/" , $somestring);  // den virker nu

//$tester = !(preg_match("/^[a-zA-Z0-9]*$/", $usernamess));

//$ko = 4;
$so = 7;

$testes = isset($ko);
echo " yes der er testes ;::     ". $testes  . "   det gik  <br>";
//$si =$ko + $tester;
//echo "ko og so lagt sammen:    " . $si . "    det skulle give 11?";

//$tester = (preg_match("/^[a-zA-Z0-9]*$/", $usernamess));

echo "<br>";
echo "hej" ;
//print_r($tester);
echo "heh <br>";
//echo "her viser vi usernamess :  :  :   " . $usernamess . " <br>  og her er tester ". $tester . "<br> og her er mere" . "<br>  yes <br> ";
//echo " her tester ::          " . $tester . "      ..";
echo "Det VAR tester  <br>";

echo $testpreg ;
echo "<br>";
echo "og her er testen forbi..";
echo "<br>";
echo "<br>";




function invalidUid($usernamess) {
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $usernamess)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

echo "resultatet af invaduid var:  ".  $result ;

*/

 ?>
 <a href="index.php">Return to main page </a >
