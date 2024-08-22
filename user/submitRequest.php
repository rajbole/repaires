<?php
include('includes/header.php');
include('../dbConnection.php');
session_start();
if ($_SESSION['is_login']){
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script>location.href='userlogin.php'</script>";
}
if(isset($_REQUEST['submitrequest'])){
    // Checking for Empty Fields
    if(($_REQUEST['requestinfo'] == "")  || ($_REQUEST['requestername'] == "") || ($_REQUEST['requesteradd1'] == "") || ($_REQUEST['requesteradd2'] == "") || ($_REQUEST['requestercity'] == "") || ($_REQUEST['requesterstate'] == "") || ($_REQUEST['requesterzip'] == "") || ($_REQUEST['requesteremail'] == "") || ($_REQUEST['requestermobile'] == "") || ($_REQUEST['requestdate'] == "")){
     // msg displayed if required field missing
     $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
    } else {
      // Assigning User Values to Variable
      $rinfo = $_REQUEST['requestinfo'];
      $rname = $_REQUEST['requestername'];
      $radd1 = $_REQUEST['requesteradd1'];
      $radd2 = $_REQUEST['requesteradd2'];
      $rcity = $_REQUEST['requestercity'];
      $rstate = $_REQUEST['requesterstate'];
      $rpin = $_REQUEST['requesterzip'];
      $remail = $_REQUEST['requesteremail'];
      $rmobile = $_REQUEST['requestermobile'];
      $rdate = $_REQUEST['requestdate'];
      $sql = "INSERT INTO submitrequest_tb(request_info, requester_name, requester_add1, requester_add2, requester_city, requester_state, requester_pin, requester_email, requester_mobile, request_date) VALUES ('$rinfo', '$rname', '$radd1', '$radd2', '$rcity', '$rstate', '$rpin', '$remail', '$rmobile', '$rdate')";
      if($conn->query($sql) == TRUE){
       // below msg display on form submit success
       $genid = mysqli_insert_id($conn);
       $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Request Submitted Successfully Your' . $genid .' </div>';
       session_start();
       $_SESSION['myid'] = $genid;
       echo "<script> location.href='submitrequestsuccess.php'; </script>";
       // include('submitrequestsuccess.php');
      } else {
       // below msg display on form submit failed
       $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Submit Your Request </div>';
      }
    }
   }
   
?>
<div class="col-sm-9 col-md-10 mt-5">
    <div class="col-sm-2 bg-info sidebar py-2">Submit Request</div>
  <form class="mx-5" action="" method="POST">
    <div class="form-group">
      <label for="inputRequestInfo">Request Info</label>
      <input type="text" class="form-control" id="inputRequestInfo" placeholder="Request Info" name="requestinfo">
    </div>
    <div class="form-group">
      <label for="inputName">Name</label>
      <input type="text" class="form-control" id="inputName" placeholder="Name" name="requestername">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputAddress">Address Line 1</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="House No. " name="requesteradd1">
      </div>
      <div class="form-group col-md-6">
        <label for="inputAddress2">Address Line 2</label>
        <input type="text" class="form-control" id="inputAddress2" placeholder="Address" name="requesteradd2">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputCity">City</label>
        <input type="text" class="form-control" id="inputCity" name="requestercity">
      </div>
      <div class="form-group col-md-4">
        <label for="inputState">State</label>
        <input type="text" class="form-control" id="inputState" name="requesterstate">
      </div>
      <div class="form-group col-md-2">
        <label for="inputZip">Pin Code</Code></label>
        <input type="text" class="form-control" id="inputZip" name="requesterzip" onkeypress="isInputNumber(event)">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail">Email</label>
        <input type="email" class="form-control" id="inputEmail" name="requesteremail">
      </div>
      <div class="form-group col-md-2">
        <label for="inputMobile">Mobile</label>
        <input type="text" class="form-control" id="inputMobile" name="requestermobile" onkeypress="isInputNumber(event)">
      </div>
      <div class="form-group col-md-2">
        <label for="inputDate">Date</label>
        <input type="date" class="form-control" id="inputDate" name="requestdate">
      </div>
    </div>

    <button type="submit" class="btn btn-info" name="submitrequest">Submit</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
  </form>
  <?php if(isset($msg)) {echo $msg; } ?>

</div>
</div>
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
include('includes/footer.php');
?>
