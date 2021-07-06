<!DOCTYPE html>
<html>

<head>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<h1>Testoverskrift</h1>

<!-- echo "1/10/2003 - %V,%G,%Y = " . strftime("%V,%G,%Y",strtotime("1/10/2003")) . "\n";  -->


<form class="form-horizontal" method="POST" action="add_datetime.php">
<fieldset>

<!-- Form Name -->
<legend>Opret ny kursusplan</legend>


<!-- First meeting input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="fm">First meeting  datetime:</label>
	<div class="col-md-4">
	<input type="datetime-local" id="fms" name="fms"
       value= "now()"
       min="2018-06-07T00:00" max="2045-06-14T00:00" >
	</div>
</div>




<!-- Submit Opret Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">Opret ny Dato</button>
  </div>
</div>


</fieldset>
</form>



<form method = "POST" action = "add_datetime.php">
	<input type = "datetime-local" id="fm" name="fm"
		value= "now()"
		min="2018-06-07T00:00" max="2045-06-14T00:00" >
		<button type = "submit">Submit this!</button>
</form>

<p>HTML  content.</p>

<?php


setlocale(LC_ALL,"hu_HU.UTF8");
echo(strftime("%Y. %B %d. %A. %X %Z"));
?>

</body>
</html>




<a href="index.php">Return to main page </a >
