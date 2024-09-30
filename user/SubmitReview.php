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




// Handle review submission
<?php
if (isset($_REQUEST['submit_review'])) {
    $rating = $_REQUEST['rating'];
    $comments = $_REQUEST['comments'];
    $service_request_id = $_REQUEST['service_request_id']; // Assuming you pass this ID

    if ($rating == "" || $comments == "") {
        $reviewMsg = '<div class="alert alert-warning mt-2" role="alert"> Fill All Fields </div>';
    } else {
        $sql = "INSERT INTO reviews (user_email, service_request_id, rating, comments) VALUES ('$rEmail', '$service_request_id', '$rating', '$comments')";
        if ($conn->query($sql) == TRUE) {
            $reviewMsg = '<div class="alert alert-success mt-2" role="alert"> Review Submitted Successfully </div>';
        } else {
            $reviewMsg = '<div class="alert alert-warning mt-2" role="alert"> Unable to Submit Review </div>';
        }
    }
}
?>


<div class="col-sm-6 mt-5"><!-- start Review area -->
    <div class="col-sm-2 bg-info sidebar py-2 text-white">Submit Review</div>
    <form action="" method="POST" class="mx-5">
        <input type="hidden" name="service_request_id" value="1"> <!-- Replace with actual service request ID -->
        <div class="form-group">
            <label for="rating">Rating (1-5)</label>
            <input type="number" class="form-control" name="rating" id="rating" min="1" max="5" required>
        </div>
        <div class="form-group">
            <label for="comments">Comments</label>
            <textarea class="form-control" name="comments" id="comments" required></textarea>
        </div>
        <button type="submit" class="btn btn-info mt-3" name="submit_review">Submit Review</button>
        <?php if (isset($reviewMsg)) { echo $reviewMsg; } ?>
    </form>
</div><!-- end Review area -->
<?php
include('includes/footer.php');
?>