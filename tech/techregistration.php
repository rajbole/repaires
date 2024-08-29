<?php
  include('../dbConnection.php');
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
            <input type="text" class="form-control" placeholder="Name" name="rName">
          </div>

          <div class="form-group">
            <i class="fas fa-envelope"></i><label for="Email" class="font-weight-bold pl-2">Email</label>
            <input type="email" class="form-control" placeholder="Email" name="rEmail">
          </div>
          <div class="form-group">
            <i class="fa fa-address-card  "></i><label for="name" class="font-weight-bold pl-2">Address</label>
            <input type="text" class="form-control" placeholder="Address" name="rName">
          </div>
          <div class="form-group">
            <i class="fa fa-wrench"></i><label for="name" class="font-weight-bold pl-2">Specializations</label>
            <input type="text" class="form-control" placeholder="Specializations" name="rName">
          </div>
          <div class="form-group">
            <i class="fas fa-user-check"></i><label for="name" class="font-weight-bold pl-2">Years of Experience</label>
            <input type="text" class="form-control" placeholder="Years of Experience" name="rName">
          </div>
          <div class="form-group">
            <i class="	fas fa-map-marker-alt"></i><label for="name" class="font-weight-bold pl-2">Location/Area of Service</label>
            <input type="text" class="form-control" placeholder="Location/Area of Service" name="rName">
          </div>

          <div class="form-group">
            <i class="fas fa-key"></i><label for="pass" class="font-weight-bold pl-2">New Password</label>
            <input type="Password" class="form-control" placeholder="Password" name="rPassword">
          </div>

          <button type="submit" class="btn btn-info mt-5 btn-block shadow-sm font-weight-bold" name="rSignup">Sign Up</button>
        </form>
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