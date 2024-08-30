<?php
  include('../dbConnection.php');

  if(isset($_REQUEST['rSignup'])){
    // Checking for Empty Fields
    if(empty($_REQUEST['tName']) || empty($_REQUEST['tEmail']) || empty($_REQUEST['tAdd']) || empty($_REQUEST['tSpec']) || empty($_REQUEST['tExe']) || empty($_REQUEST['tService'])  || empty($_REQUEST['tNum']) || empty($_REQUEST['tPassword'])){
        $regmsg = '<div class="alert alert-warning mt-2" role="alert"> All Fields are Required </div>';
    } else {
        // checking if email is already registered
        $rEmail = $_REQUEST['tEmail'];
        
        // Prepare a SELECT query to check if the email exists
        $stmt = $conn->prepare("SELECT * FROM tech_tb WHERE t_email = ?");
        $stmt->bind_param("s", $tEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            // Email already exists in the database
            $regmsg = '<div class="alert alert-warning mt-2" role="alert"> Email ID Already Registered </div>';
        } else {
            // Email is not registered, proceed with registration
            $tName = $_REQUEST['tName'];
            $tEmail = $_REQUEST['tEmail'];
            $tAdd = $_REQUEST['tAdd'];
            $tapec = $_REQUEST['tSpec'];
            $tExe = $_REQUEST['tExe'];
            $tService = $_REQUEST['tService'];
            $tNum = $_REQUEST['tNum'];
            $tPassword = $_REQUEST['tPassword'];

            // Prepare an INSERT query to add the new user
            $r_password = password_hash($tPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO tech_tb (t_name, t_email, t_add, t_special, t_experiance, t_area, t_phone, t_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $tName, $tEmail, $tAdd, $tSpec, $tExe, $tService, $tNum, $tPassword);

            if($stmt->execute()){
                $regmsg = '<div class="alert alert-success mt-2" role="alert"> Account Successfully Created </div>';
            } else {
                $regmsg = '<div class="alert alert-danger mt-2" role="alert"> Unable to Create Account </div>';
            }
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
  <div class="container pt-5" id="registration">
    <h2 class="text-center">Create an technician Account</h2>
    <div class="raw mt-4 mv-4">
      <div class="col-md-6 offset-md-3">
        <form action="" class="shadow-lg p-4" method="POST">
          <div class="form-group">
            <i class="fas fa-user"></i><label for="name" class="font-weight-bold pl-2">Name</label>
            <input type="text" class="form-control" placeholder="Name" name="tName">
          </div>

          <div class="form-group">
            <i class="fas fa-envelope"></i><label for="Email" class="font-weight-bold pl-2">Email</label>
            <input type="email" class="form-control" placeholder="Email" name="tEmail">
          </div>
          <div class="form-group">
            <i class="fa fa-address-card  "></i><label for="name" class="font-weight-bold pl-2">Address</label>
            <input type="text" class="form-control" placeholder="Address" name="tAdd">
          </div>
          <div class="form-group">
            <i class="fa fa-wrench"></i><label for="name" class="font-weight-bold pl-2">Specializations</label>
            <input type="text" class="form-control" placeholder="Specializations" name="tSpec">
          </div>
          <div class="form-group">
            <i class="fas fa-user-check"></i><label for="name" class="font-weight-bold pl-2">Years of Experience</label>
            <input type="text" class="form-control" placeholder="Years of Experience" name="tExe">
          </div>
          <div class="form-group">
            <i class="	fas fa-map-marker-alt"></i><label for="name" class="font-weight-bold pl-2">Location/Area of Service</label>
            <input type="text" class="form-control" placeholder="Location/Area of Service" name="tService">
          </div>
          <div class="form-group">
            <i class="	fas fa-phone"></i><label for="name" class="font-weight-bold pl-2">Contact Number</label>
            <input type="text" class="form-control" placeholder="phone no." name="tNum">
          </div>

          <div class="form-group">
            <i class="fas fa-key"></i><label for="pass" class="font-weight-bold pl-2">New Password</label>
            <input type="Password" class="form-control" placeholder="Password" name="tPassword">
          </div>

          <button type="submit" class="btn btn-info mt-5 btn-block shadow-sm font-weight-bold" name="rSignup">Sign Up</button>
          <?php if(isset($regmsg)) {echo $regmsg;} ?>
        </form>
        <div class="text-center"><a class="btn btn-info mt-3 shadow-sm font-weight-bold" href="../index.php">Back to Home</a></div>
      </div>
    </div>
  </div>
     <!-- End Registration  -->

  <!-- Boostrap JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/all.min.js"></script>
</body>

</html>