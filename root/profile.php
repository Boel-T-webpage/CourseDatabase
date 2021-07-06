<!--Splitting the header and footer into separate documents makes things easier!-->
<?php
include_once 'includes/dbh.inc.php';
include_once 'header.php';
?>

<section class="index-intro">
  <h1>Profilos</h1>
  <p>Here is an important paragraph that explains the purpose of the website and why you are here!</p>
</section>

<section class="index-categories">
  <h2>Some Basic Categories</h2>

   <?php
	  global $conn;
	  $userid=$_SESSION["userid"];
	  $unitag=getTag($conn,$userid,0,"uni");
	  echo "Dit brugerid: ".$userid."<br>";
	  echo "Unitag: ".$unitag;

	  saveTag($conn,$userid,0,"wtf","ooh la la");
	  ?>

  <div class="index-categories-list">
    <div>
      <h3>Fun Stuff</h3>
    </div>
    <div>
      <h3>Serious Stuff</h3>

    </div>
    <div>
      <h3><a href = "courseform_new.php">Create new course plan</h3>
    </div>
    <div>
      <h3>Boring Stuff</h3>
    </div>
  </div>
</section>

<?php
  include_once 'footer.php';
?>
