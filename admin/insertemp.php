<?php
include('includes/dheader.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
if(isset($_REQUEST['empsubmit'])){
 // Checking for Empty Fields
 if(($_REQUEST['empName'] == "") || ($_REQUEST['empCity'] == "") || ($_REQUEST['empMobile'] == "") || ($_REQUEST['empEmail'] == "") || ($_REQUEST['empSpecial'] == "") || ($_REQUEST['empExperiance'] == "") || ($_REQUEST['empPassword'] == "")){
  // msg displayed if required field missing
  $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
 } else {
   // Assigning User Values to Variable
   $eName = $_REQUEST['empName'];
   $eCity = $_REQUEST['empCity'];
   $eMobile = $_REQUEST['empMobile'];
   $eEmail = $_REQUEST['empEmail'];
   $eSpecial = $_REQUEST['empSpecial'];
   $eExp = $_REQUEST['empExperiance'];
   $ePassword = $_REQUEST['empPassword'];
   $sql = "INSERT INTO technician_tb (empName, empCity, empMobile, empEmail, empSpecial, empExperiance, empPassword) VALUES ('$eName', '$eCity','$eMobile', '$eEmail', '$eSpecial', '$eExp', '$ePassword')";
   if($conn->query($sql) == TRUE){
    // below msg display on form submit success
    $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Added Successfully </div>';
   } else {
    // below msg display on form submit failed
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add </div>';
   }
 }
 }
?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New Technician</h3>
  <form action="" method="POST">
    <div class="form-group">
      <label for="empName">Name</label>
      <input type="text" class="form-control" id="empName" name="empName">
    </div>
    <div class="form-group">
      <label for="empCity">City</label>
      <input type="text" class="form-control" id="empCity" name="empCity">
    </div>
    <div class="form-group">
      <label for="empMobile">Mobile</label>
      <input type="text" class="form-control" id="empMobile" name="empMobile" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="empEmail">Email</label>
      <input type="email" class="form-control" id="empEmail" name="empEmail">
    </div>
    <div class="form-group">
      <label for="empSpecial">Special</label>
      <input type="text" class="form-control" id="empSpecial" name="empSpecial">
    </div>
    <div class="form-group">
      <label for="empExperiance">Experiance</label>
      <input type="text" class="form-control" id="empExperiance" name="empExperiance" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="empPassword">Password</label>
      <input type="text" class="form-control" id="empPassword" name="empPassword">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-info" id="empsubmit" name="empsubmit">Submit</button>
      <a href="technician.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>
<?php
include('includes/dfooter.php'); 
?>