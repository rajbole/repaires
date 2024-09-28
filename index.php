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

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/custom.css">

  <title>rapidrepair</title>
</head>

<body>
  <!-- Start Navigation -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-info pl-5 fixed-top">
  <img href="index.php" src="images/lg.png" alt="" class="logo" width="50px">
    <span class="navbar-text">Happiness of customers</span>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myMenu">
      <ul class="navbar-nav pl-5 custom-nav">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="#Services" class="nav-link">Services</a></li>
        <li class="nav-item"><a href="#registration" class="nav-link">Registration</a></li>
        <li class="nav-item"><a href="user/userlogin.php" class="nav-link">Login</a></li>
        <li class="nav-item"><a href="#Contact" class="nav-link">Contact</a></li>
        <li class="nav-item"><a href="tech/techpage.php" class="nav-link">technicians</a></li>
      </ul>
    </div>
  </nav> <!-- End Navigation -->

  <!-- Start Header Jumbotron-->
  <header class="jumbotron back-image" style="background-image: url(images/techisian.webp);">
    <div class="myclass mainHeading">
      <h1 class="text-uppercase text-danger font-weight-bold">Welcome to Rapid Repair</h1>
      <p class="font-italic text-denger">Customer's Happiness is our Aim</p>
      <a href="user/userlogin.php" class="btn btn-info mr-4">Login</a>
      <a href="#registration" class="btn btn-info mr-4">Sign Up</a>
    </div>
  </header> <!-- End Header Jumbotron -->

  <div class="container">
    <!--Introduction Section-->
    <div class="jumbotron">
      <h3 class="text-center">RAPID REPAIR</h3>
      <p>
      we’re revolutionizing the way users handle their maintenance needs. Our platform is designed to streamline and expedite the repair process, offering a user-friendly interface that allows customers to quickly request services, track progress in real-time, and receive timely updates from certified technicians. By integrating advanced scheduling tools and a robust notification system, we ensure that maintenance issues are addressed promptly and efficiently. With our commitment to quality service and customer satisfaction, Rapid Repair is set to transform the maintenance industry, making it easier than ever for users to get the repairs they need, when they need them.
      </p>

    </div>
  </div>
  <!--Introduction Section End-->
  <!-- Start Services -->
  <div class="container text-center border-bottom" id="Services">
    <h2>Our Services</h2>
    <div class="row mt-4">
      <div class="col-sm-4 mb-4">
        <a href="#"><i class="fas fa-tv fa-8x text-success"></i></a>
        <h4 class="mt-4">Electronic Device</h4>
      </div>
      <div class="col-sm-4 mb-4">
        <a href="#"><i class="fas fa-sliders-h fa-8x text-primary"></i></a>
        <h4 class="mt-4">Maintenance</h4>
      </div>
      <div class="col-sm-4 mb-4">
        <a href="#"><i class="fas fa-cogs fa-8x text-info"></i></a>
        <h4 class="mt-4">Fault Repair</h4>
      </div>
    </div>
  </div> <!-- End Services -->

  <!-- Start Registration  -->
   <?php include('UserRegistration.php') ?>
     <!-- End Registration  -->
  
<!-- reviwe section satrt -->

<div class="container pt-5" id="reviews">
  <h2 class="text-center">Customer Reviews</h2>
  <div class="row mt-4">
    <!-- PHP code will generate reviews here -->
    <?php
    include('dbconnection.php'); // Make sure to include your database connection file

    // Fetch reviews from the database
    $sql = "SELECT review_id, user_email, service_request_id, rating, comments, created_at FROM reviews ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">' . htmlspecialchars($row["user_email"]) . '</h5>
              <h6 class="card-subtitle mb-2 text-muted">Rating: ' . htmlspecialchars($row["rating"]) . '/5</h6>
              <p class="card-text">' . htmlspecialchars($row["comments"]) . '</p>
            </div>
            <div class="card-footer bg-info text-white">
              ' . date("F j, Y", strtotime($row["created_at"])) . '
            </div>
          </div>
        </div>
        ';
      }
    } else {
      echo '<p class="text-center">No reviews yet. Be the first to leave a review!</p>';
    }
    
    // Close the database connection
    $conn->close();
    ?>
  </div>
</div>

 <!-- reviwe section end -->

  <!-- contact  -->
  <?php include('Contactform.php') ?>
<!-- end contact -->
        <div class="col-md-4 text-center">
          <strong>Headquarter:</strong><br>
          rapidrepair pvt ltd.<br>
          Devrukh , Ratnagiri<br>
          Sangameshwar - 415610<br>
          phone: +91 00000 00000<br>
          <a href="#" target="_blank">www.rapidrepair.com</a><br>
          <br> <br>
          <strong>Branch:</strong><br>
          rapidrepair pvt ltd.<br>
          Ratnagiri , Maharastra<br>
          Sangameshwar - 415611<br>
          phone: +91 00000 00000<br>
          <a href="#" target="_blank">www.rapidrepair.com</a><br>

      </div>

    </div>
   </div>

   <!-- start footer -->
    <footer class="container-fluid bg-info mt-5 text-white">
      <div class="container">
        <div class="row py-3">
          <div class="col-md-6">
            <span class="pr-2">Follow Us :</span>
            <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-facebook-f"></i></a>
            <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-twitter"></i></a>
            <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-youtube"></i></a>
          </div>
          <div class="col-md-6 text-right">
            <small class="ml-2"><a href="admin/login.php">Admin Login</a></small>
          </div>
        </div>
      </div>

    </footer>

  
  <!-- Boostrap JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/all.min.js"></script>
</body>

</html>