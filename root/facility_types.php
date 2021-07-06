<!--Splitting the header and footer into separate documents makes things easier!-->
<?php
  include_once 'header.php';
?>

<section class="index-intro">
  <h1>Facilitetstyper</h1>
  <p>Her kan administreres facilitetstyper</p>
</section>

<section class="common-content">

<form method="post" action="facility_types_add.php">
Navn: <input type="text" name="facility_name">
<input type="submit" value="Opret">
</form>

</select>

<?php
  include_once 'footer.php';
?>
