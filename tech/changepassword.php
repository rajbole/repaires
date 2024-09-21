<?php
include('include/theader.php');
include('../dbConnection.php');
session_start();
if ($_SESSION['is_login']){
    $eEmail = $_SESSION['empEmail'];
} else {
    echo "<script>location.href='techlogin.php'</script>";
}
$eEmail = $_SESSION['empEmail'];
if(isset($_REQUEST['passupdate'])){
 if(($_REQUEST['empPassword'] == "")){
  // msg displayed if required field missing
  $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
 } else {
   $sql = "SELECT * FROM technician_tb WHERE empEmail='$eEmail'";
   $result = $conn->query($sql);
   if($result->num_rows == 1){
    $ePassword = $_REQUEST['empPassword'];
    $sql = "UPDATE technician_tb SET empPassword = '$ePassword' WHERE empEmail = '$eEmail'";
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
          <input type="email" class="form-control" id="inputEmail"  value=" <?php echo $eEmail ?>"  readonly>
        </div>
        <div class="form-group">
          <label for="inputnewpassword">New Password</label>
          <input type="password" class="form-control" id="inputnewpassword" placeholder="New Password" name="empPassword">
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
include('include/tfooter.php');
?>
