<?php
include('includes/header.php');
include('../dbConnection.php');
session_start();
if ($_SESSION['is_login']){
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script>location.href='userlogin.php'</script>";
}
$rEmail = $_SESSION['rEmail'];
if(isset($_REQUEST['passupdate'])){
 if(($_REQUEST['rPassword'] == "")){
  // msg displayed if required field missing
  $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
 } else {
   $sql = "SELECT * FROM user_tb WHERE u_email='$rEmail'";
   $result = $conn->query($sql);
   if($result->num_rows == 1){
    $rPass = $_REQUEST['rPassword'];
    $sql = "UPDATE user_tb SET u_password = '$rPass' WHERE u_email = '$rEmail'";
     if($conn->query($sql) == TRUE){
      // below msg display on form submit success
      $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
     } else {
      // below msg display on form submit failed
      $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
     }
   }
  }
}

?>

<div class="col-sm-9 col-md-10 mt-5"><!-- user change password -->
<div class="col-sm-2 bg-info sidebar py-2">Change Password</div>
<div class="row">
    <div class="col-sm-6">
      <form class="mt-5 mx-5" method="POST">
        <div class="form-group">
          <label for="inputEmail">Email</label>
          <input type="email" class="form-control" id="inputEmail"  value=" <?php echo $rEmail ?>"  readonly>
        </div>
        <div class="form-group">
          <label for="inputnewpassword">New Password</label>
          <input type="password" class="form-control" id="inputnewpassword" placeholder="New Password" name="rPassword">
        </div>
        <button type="submit" class="btn btn-info mr-4 mt-4" name="passupdate">Update</button>
        <button type="reset" class="btn btn-secondary mt-4">Reset</button>
        <?php if(isset($passmsg)) {echo $passmsg; } ?>
      </form>

    </div>

  </div>
</div>
</div>
</div><!-- user change password  close-->
<?php
include('includes/footer.php');
?>
