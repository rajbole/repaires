<?php
include('includes/header.php');
include('../dbConnection.php');
session_start();
if ($_SESSION['is_login']){
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script>location.href='userlogin.php'</script>";
}
$sql = "SELECT u_name, u_email FROM user_tb WHERE u_email = '$rEmail'";
$result = $conn->query($sql);
if ($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $rName =$row['u_name'];
}

if(isset($_REQUEST['nameupdate'])){
    if($_REQUEST['rName'] == ""){
        $passmsg = '<div class="alert alert-warning mt-2" role="alert"> Fill All Fields </div>';
    } else {
        $rName = $_REQUEST['rName'];
        $sql = "UPDATE user_tb SET u_name = '$rName' WHERE u_email = '$rEmail'";
        if($conn->query($sql) == TRUE){
            $passmsg = '<div class="alert alert-success mt-2" role="alert"> Updated Successfuly </div>';
        } else {
            $passmsg = '<div class="alert alert-warning mt-2" role="alert"> Unablte TO Update </div>';
        }
    }
}
?>


        <div class="col-sm-6 mt-5"><!-- start Profile area -->
        <div class="col-sm-2 bg-info sidebar py-2 text-white">Profile</div>
            <form action="" method="POST" class="mx-5">
                <div class="from-group">
                    <label for="rEmail">Email</label><input type="email" class="form-control" name="rEmail" id="rEmail" value="<?php echo $rEmail ?>" readonly>
                </div>
                <div class="from-group">
                    <label for="rName">Name</label><input type="text" class="form-control" name="rName" id="rName" value="<?php echo $rName ?>">
                </div>
                <button type="submit" class="btn btn-info mt-3" name="nameupdate">Update</button>
                <?php if(isset($passmsg)) {echo $passmsg;} ?>
            </form>
        </div><!-- end Profile area -->
        
<?php
include('includes/footer.php');
?>