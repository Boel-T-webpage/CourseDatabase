<!--Splitting the header and footer into separate documents makes things easier!-->
<?php
  require_once "includes/dbh.inc.php";
  include_once 'header.php';
?>

<section class="index-intro">
  <h1>This Is An Introduction</h1>
  <p>Here is an important paragraph that explains the purpose of the website and why you are here!</p>
</section>

<section class="signup-form">
  <h2>Log In</h2>
  <div class="signup-form-form">
    <form action="includes/create_course.inc.php" method="post">
      <input type="text" name="c_number" placeholder="Course ID / number">
      <input type="text" name="c_name" placeholder="Course name / title">
      <input type="date" name="c_start_date" placeholder="Start date">
      <input type="date" name="c_end_date" placeholder="End date">
      <input type="text" name="c_responsible" placeholder="Course responsible">
      <input type="number" step="any" name="c_credits" placeholder="Credits / ECTS">



<!--   Course type input  -->
      <label for="c_type">Course type:</label>


<input type="text" name="c_type" list="c_type_list">
<datalist id="c_type_list">
  <?php $t = get_c_types($conn);
  for ($i=0 ; $i<count($t) ; $i++){
    $type = $t[$i];
    echo "<option value = \"".$type["c_type_id"]."\">";
    echo $type["c_type_name"];
    echo "</option>";
  } ?>
</datalist>


<!--   department  input  -->
      <label for="dep">Host department:</label>


<input type="text" name="c_dep" list="dep_list">
<datalist id="dep_list">
  <?php $t = get_c_dep($conn);
  for ($i=0 ; $i<count($t) ; $i++){
    $type = $t[$i];
    echo "<option value = \"".$type["dep_id"]."\">";
    echo $type["dep_name"];
    echo "</option>";
  } ?>
</datalist>
<!--   department  input hertil - - -  - -   -->

      <!--<input type="text" name="c_type" placeholder="Course type">-->
      <input type="text" name="c_assessment" placeholder="Type of assessment">
      <!-- <input type="text" name="c_dep" placeholder="Course under department"> -->
      <input type="text" name="c_exam_dur" placeholder="Exam duration">



      <!--   Facilities  input  -->
            <label for="fac">Facilities needed:</label>


        <?php $t = get_fac($conn);
        for ($i=0 ; $i<count($t) ; $i++){
          $type = $t[$i];
          #echo "<option value = \"".$type["dep_id"]."\">";
          echo $type["fac_name"];

          echo "<input type=\"number\"  name=\"facs[".$type["fac_id"]."]\" placeholder=\"".$type["fac_name"]."\">";
          //echo "<option value = \"".$type["c_type_id"]."\">";
} ?>

      <!--   Facilities  input hertil - - -  - -   -->



  <!-- HER BEGYNDER SUBMIN; FORMEN ER SLUT - - -  - -   -->
      <button type="submit" name="submit">Create course</button>
    </form>
  </div>
  <?php
    // Error messages
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
      }
      else if ($_GET["error"] == "wronglogin") {
        echo "<p>Wrong login!</p>";
      }
    }
  ?>
</section>

<?php
  include_once 'footer.php';
?>
