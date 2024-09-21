<?php
include('include/theader.php');
include('../dbConnection.php');
session_start();

if (!$_SESSION['is_login']) {
    echo "<script>location.href='techlogin.php'</script>";
    exit();
}

$eEmail = $_SESSION['empEmail'];
?>

<div class="col-sm-9 col-md-10 mt-5">
    <div class="col-sm-2 bg-info sidebar py-2 text-white">Your Work</div>

    <!-- Start second column -->
    <div class="col-sm-6 mt-5  mx-3">
        <form action="" class="mt-3 form-inline d-print-none">
            <div class="form-group mr-3">
                <label for="empEmail">Enter Requester Email: </label>
                <input type="email" class="form-control ml-3" id="empEmail" name="empEmail" required>
            </div>
            <button type="submit" class="btn btn-info">Search</button>
        </form>

        <?php
        if (isset($_REQUEST['empEmail'])) {
            $email = $conn->real_escape_string($_REQUEST['empEmail']);
            $sql = "SELECT * FROM assignwork_tb WHERE empEmail = '{$email}'";
            $result = $conn->query($sql);

            // Check if results are found
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <h3 class="text-center mt-5">Assigned Work Details</h3>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Request ID</td>
                            <td>
                                <?php if (isset($row['request_id'])) {
                                    echo $row['request_id'];
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Request Info</td>
                            <td>
                                <?php if (isset($row['request_info'])) {
                                    echo $row['request_info'];
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>
                                <?php if (isset($row['requester_name'])) {
                                    echo $row['requester_name'];
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Address Line 1</td>
                            <td>
                                <?php if (isset($row['requester_add1'])) {
                                    echo $row['requester_add1'];
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Address Line 2</td>
                            <td>
                                <?php if (isset($row['requester_add2'])) {
                                    echo $row['requester_add2'];
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>
                                <?php if (isset($row['requester_city'])) {
                                    echo $row['requester_city'];
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>
                                <?php if (isset($row['requester_state'])) {
                                    echo $row['requester_state'];
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pin Code</td>
                            <td>
                                <?php if (isset($row['requester_pin'])) {
                                    echo $row['requester_pin'];
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <?php if (isset($row['requester_email'])) {
                                    echo $row['requester_email'];
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>
                                <?php if (isset($row['requester_mobile'])) {
                                    echo $row['requester_mobile'];
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Assigned Date</td>
                            <td>
                                <?php if (isset($row['assign_date'])) {
                                    echo $row['assign_date'];
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Assigned Technician</td>
                            <td>
                                <?php if (isset($row['assign_tech'])) {
                                    echo $row['assign_tech'];
                                } ?>
                            </td>
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
                </table>
                <div class="text-center">
                    <button class="btn btn-info" onClick="window.print()">Print</button>
                    <form class="d-inline" action="pendingrequest.php">
                        <input class="btn btn-secondary" type="submit" value="Close">
                    </form>
                </div>
            <?php
            } else {
                // No records found
                echo '<div class="alert alert-dark mt-4" role="alert">No work found for this email.</div>';
            }
        }
        ?>
    </div><!-- End second column -->

    <?php
    include('include/tfooter.php');
    ?>