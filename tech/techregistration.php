<?php
  include('../dbConnection.php');

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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="css/all.min.css">

  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

  <title>technician</title>
</head>

<body>
  <!-- Start Registration  -->
  

<div class="mt-5  mx-3 jumbotron myclass mainHeading">
  <h3 class="text-center">Technician Registration</h3>
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
      <label for="empEmail">Speciality</label>
      <input type="text" class="form-control" id="empSpecial" name="empSpecial">
    </div>
    <div class="form-group">
      <label for="empExperiance">empExperiance</label>
      <input type="text" class="form-control" id="empExperiance" name="empExperiance">
    </div>
    <div class="form-group">
      <label for="empPassword">Password</label>
      <input type="text" class="form-control" id="empPassword" name="empPassword">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-info" id="empsubmit" name="empsubmit">Submit</button>
      <a href="techlogin.php" class="btn btn-danger">Go to Login</a>
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
     <!-- End Registration  -->

  <!-- Boostrap JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/all.min.js"></script>
</body>

</html>