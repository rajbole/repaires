<?php
include('include/theader.php');
include('../dbConnection.php');
session_start();

if (!$_SESSION['is_login']) {
    echo "<script>location.href='techlogin.php'</script>";
    exit();
}

$eEmail = $_SESSION['empEmail'];

if (isset($_REQUEST['submit_review'])) {
    $request_id = $_REQUEST['request_id'];
    $rating = $_REQUEST['rating'];
    $comments = $_REQUEST['comments'];

    if ($rating == "" || $comments == "") {
        $reviewMsg = '<div class="alert alert-warning mt-2" role="alert"> Fill All Fields </div>';
    } else {
        $sql = "INSERT INTO technician_reviews (request_id, empEmail, rating, comments) VALUES ('$request_id', '$eEmail', '$rating', '$comments')";
        if ($conn->query($sql) === TRUE) {
            $reviewMsg = '<div class="alert alert-success mt-2" role="alert"> Review Submitted Successfully </div>';
        } else {
            $reviewMsg = '<div class="alert alert-warning mt-2" role="alert"> Unable to Submit Review </div>';
        }
    }
}
?>

<div class="col-sm-9 col-md-10 mt-5">
    <div class="col-sm-2 bg-info sidebar py-2 text-white">Complete Task</div>

    <!-- Start second column -->
    <div class="col-sm-6 mt-5 mx-3">
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

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $request_id = $row['request_id']; // Save the request ID for later use
                ?>
                <h3 class="text-center mt-5">Assigned Work Details</h3>
                <table class="table table-bordered">
                    <tbody>
                        <!-- (Other rows remain unchanged) -->
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
                            <td>
                                <?php if (isset($row['requester_name'])) {
                                    echo $row['requester_name'];
                                } ?>
                            </td>
                        </tr>
                        <!-- (Other fields) -->
                    </tbody>
                </table>

                <h3 class="text-center mt-5">Submit Review</h3>
                <form action="" method="POST" class="mt-3">
                    <input type="hidden" name="request_id" value="<?php echo $request_id; ?>">
                    <div class="form-group">
                        <label for="rating">Rating (1-5)</label>
                        <input type="number" class="form-control" name="rating" id="rating" min="1" max="5" required>
                    </div>
                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <textarea class="form-control" name="comments" id="comments" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-info" name="submit_review">Complete and Submit Review</button>
                </form>
                <?php if (isset($reviewMsg)) { echo $reviewMsg; } ?>

                <div class="text-center">
                        <input class="btn btn-secondary" type="submit" value="Close">
                    </form>
                </div>
            <?php
            } else {
                echo '<div class="alert alert-dark mt-4" role="alert">No work found for this email.</div>';
            }
        }
        ?>
    </div><!-- End second column -->

    <?php
    include('include/tfooter.php');
    ?>