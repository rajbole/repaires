<?php
include('include/theader.php');
include('../dbConnection.php');
session_start();
if ($_SESSION['is_login']){
    $eEmail = $_SESSION['empEmail'];
} else {
    echo "<script>location.href='techlogin.php'</script>";
}
$sql = "SELECT empName, empEmail FROM technician_tb WHERE empEmail = '$eEmail'";
$result = $conn->query($sql);
if ($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $eName =$row['empName'];
}

if(isset($_REQUEST['nameupdate'])){
    if($_REQUEST['empName'] == ""){
        $passmsg = '<div class="alert alert-warning mt-2" role="alert"> Fill All Fields </div>';
    } else {
        $eName = $_REQUEST['empName'];
        $sql = "UPDATE technician_tb SET empName = '$eName' WHERE empEmail = '$eEmail'";
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
                    <label for="empEmail">Email</label><input type="email" class="form-control" name="empEmail" id="empEmail" value="<?php echo $eEmail ?>" readonly>
                </div>
                <div class="from-group">
                    <label for="empName">Name</label><input type="text" class="form-control" name="empName" id="empName" value="<?php echo $eName ?>">
                </div>
                <button type="submit" class="btn btn-info mt-3" name="nameupdate">Update</button>
                <?php if(isset($passmsg)) {echo $passmsg;} ?>
            </form>
        </div><!-- end Profile area -->
        
<?php
include('include/tfooter.php');
?>