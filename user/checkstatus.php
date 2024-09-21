<?php
include('includes/header.php');
include('../dbConnection.php');
session_start();
if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script>location.href='userlogin.php'</script>";
}
?>
<div class="col-sm-9 col-md-10 mt-5">
    <div class="col-sm-2 bg-info sidebar py-2 text-white">Check Status</div>

    <!-- start second column -->
    <div class="col-sm-6 mt-5 mx-3">
        <form action="" class="mt-3 form-inline d-print-none">
            <div class="form-group mr-3">
                <label for="checkid">Enter Request ID: </label>
                <input type="text" class="form-control ml-3" id="checkid" name="checkid" onkeypress="isInputNumber(event)">
            </div>
            <button type="submit" class="btn btn-info">Search</button>
        </form>

        <?php
        if (isset($_REQUEST['checkid'])) {
            // Escape the input to prevent SQL injection
            $requestId = $conn->real_escape_string($_REQUEST['checkid']);
            $sql = "SELECT * FROM assignwork_tb WHERE request_id = '{$requestId}'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <h3 class="text-center mt-5">Assigned Work Details</h3>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Request ID</td>
                            <td><?php echo $row['request_id']; ?></td>
                        </tr>
                        <tr>
                            <td>Request Info</td>
                            <td><?php echo $row['request_info']; ?></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $row['requester_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Address Line 1</td>
                            <td><?php echo $row['requester_add1']; ?></td>
                        </tr>
                        <tr>
                            <td>Address Line 2</td>
                            <td><?php echo $row['requester_add2']; ?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td><?php echo $row['requester_city']; ?></td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td><?php echo $row['requester_state']; ?></td>
                        </tr>
                        <tr>
                            <td>Pin Code</td>
                            <td><?php echo $row['requester_pin']; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $row['requester_email']; ?></td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td><?php echo $row['requester_mobile']; ?></td>
                        </tr>
                        <tr>
                            <td>Assigned Date</td>
                            <td><?php echo $row['assign_date']; ?></td>
                        </tr>
                        <tr>
                            <td>Assigned Technician</td>
                            <td><?php echo $row['assign_tech']; ?></td>
                        </tr>
                        <tr>
                            <td>Customer Sign</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Technician Sign</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <form class="d-print-none d-inline mr-3"><input class="btn btn-info" type="button" value="Print" onClick="window.print()"></form>
                    <form class="d-print-none d-inline" action="checkstatus.php"><input class="btn btn-secondary" type="submit" value="Close"></form>
                </div>
                <?php 
            } else {
                echo '<div class="alert alert-dark mt-4" role="alert">Your Request is Still Pending or Invalid Request ID.</div>';
            }
        }
        ?>

    </div><!-- End second column -->
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