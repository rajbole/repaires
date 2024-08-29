<?php
include('includes/dheader.php');
include('../dbConnection.php');
session_start();
if (isset($_SESSION['is_adminlogin'])) {
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script>location.href='login.php'</script>";
}
?>
<div class="col-sm-9 col-md-10 mt-5"><!-- user change password -->
    <div class="col-sm-2 bg-info sidebar py-2 text-white">Request</div>
    <div class="col-sm-6 mb-5 mt-5"><!-- satrt 2nd column -->
        <?php
        $sql = "SELECT request_id, request_info, request_date FROM submitrequest_tb";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card mt-5 mx-5">';
                echo '<div class="card-header">';
                echo 'Request ID:' . $row['request_id'];
                echo '</div>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">Reqest Info :    ' . $row['request_info'];
                echo '</h5>';
                echo '<p class="card-text">Request Date: ' . $row['request_date'];
                echo '</p>';
                echo '<div class="float-right">';
                echo '<form action="" method="POST">';
                echo '<input type="hidden" name="id" value=' . $row["request_id"] . '>';
                echo '<input type="submit" class="btn btn-info mr-3" name="view" value="View">';
                echo '<input type="submit" class="btn btn-danger" name="Delete" value="Delete">';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div><!-- satrt 2nd column -->

    <?php
    include('assignworkform.php');
    include('includes/dfooter.php');
    ?>