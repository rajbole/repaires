<?php
if (isset($_REQUEST['view'])) {
    $sql = "SELECT * FROM submitrequest_tb WHERE request_id = {$_REQUEST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
// Check if the 'Delete' button was clicked and 'id' is set
if (isset($_REQUEST['Delete']) && isset($_REQUEST['id'])) {
    // Retrieve the request ID
    $id = $_REQUEST['id'];

    // Prepare the SQL delete statement
    $sql = "DELETE FROM submitrequest_tb WHERE request_id = ?";

    // Use prepared statements to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter (i for integer type)
        $stmt->bind_param("i", $id);

        // Execute the statement
        if ($stmt->execute()) {
            echo '<meta http-equiv="refresh" content="0;URL=?closed" />';
        } else {
            echo '<div class="alert alert-warning mt-2" role="alert"> Unable To Delete </div>';
        }
    }
}

if (isset($_REQUEST['Assign'])) {
    // Validate if all required fields are filled
    if (empty($_REQUEST['request_id']) || empty($_REQUEST['request_info']) || empty($_REQUEST['requestername']) || empty($_REQUEST['address1']) || empty($_REQUEST['address2']) || empty($_REQUEST['requestercity']) || empty($_REQUEST['requesterstate']) || empty($_REQUEST['requesterzip']) || empty($_REQUEST['requesteremail']) || empty($_REQUEST['requestermobile']) || empty($_REQUEST['assigntech']) || empty($_REQUEST['inputdate'])) {
        $msg = '<div class="alert alert-warning mt-2" role="alert"> All Fields Require </div>';
    } else {
        // Retrieve and sanitize the values from the request
        $rid = $conn->real_escape_string($_REQUEST['request_id']);
        $rinfo = $conn->real_escape_string($_REQUEST['request_info']);
        $rname = $conn->real_escape_string($_REQUEST['requestername']);
        $radd1 = $conn->real_escape_string($_REQUEST['address1']);
        $radd2 = $conn->real_escape_string($_REQUEST['address2']);
        $rcity = $conn->real_escape_string($_REQUEST['requestercity']);
        $rstate = $conn->real_escape_string($_REQUEST['requesterstate']);
        $rpin = $conn->real_escape_string($_REQUEST['requesterzip']);
        $remail = $conn->real_escape_string($_REQUEST['requesteremail']);
        $rmobile = $conn->real_escape_string($_REQUEST['requestermobile']);
        $rtech = $conn->real_escape_string($_REQUEST['assigntech']);
        $rdate = $conn->real_escape_string($_REQUEST['inputdate']);

        // Correct the SQL query with sanitized variables
        $sql = "INSERT INTO assignwork_tb (request_id, request_info, requester_name, requester_add1, requester_add2, requester_city, requester_state, requeter_pin, requester_email, requester_mobile, assign_tech, assign_date) VALUES ('$rid', '$rinfo', '$rname', '$radd1', '$radd2', '$rcity', '$rstate', '$rpin', '$remail', '$rmobile', '$rtech', '$rdate')";

        if ($conn->query($sql) === TRUE) {
            $msg = '<div class="alert alert-success mt-2" role="alert"> Assign Successfully </div>';
        } else {
            $msg = '<div class="alert alert-danger mt-2" role="alert"> Unable to Assign: ' . $conn->error . '</div>';
        }
    }
}
?>

<div class="col-sm-6 mt-5 jumbotron"> <!-- start assigned work -->
    <form action="" method="POST">
        <h5 class="text-center">Assign Work order Request</h5>
        <div class="from-group">
            <label for="request_id">Reqest ID</label>
            <input type="text" class="form-control" id="request_id" name="request_id" value="<?php if (isset($row['request_id']))
                echo $row['request_id']; ?>" readonly>
        </div>
        <div class="from-group">
            <label for="request_info">Reqest Info</label>
            <input type="text" class="form-control" id="request_info" name="request_info" value="<?php if (isset($row['request_info']))
                echo $row['request_info']; ?>">
        </div>
        <div class="from-group">
            <label for="requestername">Name</label>
            <input type="text" class="form-control" id="requestername" name="requestername" value="<?php if (isset($row['requester_name']))
                echo $row['requester_name']; ?>">
        </div>
        <div class="form-row">
            <div class="from-group col-md-6">
                <label for="address1">Address 1</label>
                <input type="text" class="form-control" id="address1" name="address1" value="<?php if (isset($row['requester_add1']))
                    echo $row['requester_add1']; ?>">
            </div>
            <div class="from-group col-md-6">
                <label for="address2">Address 2</label>
                <input type="text" class="form-control" id="address2" name="address2" value="<?php if (isset($row['requester_add2']))
                    echo $row['requester_add2']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="requestercity0\">City</label>
                <input type="text" class="form-control" id="requestercity" name="requestercity" value="<?php if (isset($row['requester_city']))
                    echo $row['requester_city']; ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="requesterstate">State</label>
                <input type="text" class="form-control" id="requesterstate" name="requesterstate" value="<?php if (isset($row['requester_state']))
                    echo $row['requester_state']; ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="requesterzip">Code</label>
                <input type="text" class="form-control" id="requesterzip" name="requesterzip"
                    onkeypress="isInputNumber(event)" value="<?php if (isset($row['requester_pin']))
                        echo $row['requester_pin']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="requesteremail">Email</label>
                <input type="email" class="form-control" id="requesteremail" name="requesteremail" value="<?php if (isset($row['requester_email']))
                    echo $row['requester_email']; ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="requestermobile">Mobile</label>
                <input type="text" class="form-control" id="requestermobile" name="requestermobile"
                    onkeypress="isInputNumber(event)" value="<?php if (isset($row['requester_mobile']))
                        echo $row['requester_mobile']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="assigntech">Assign Technician</label>
                <input type="text" class="form-control" id="assigntech" name="assigntech">
            </div>
            <div class="form-group col-md-6">
                <label for="inputDate">Date</label>
                <input type="date" class="form-control" id="inputDate" name="inputdate">
            </div>
        </div>
        <div class="flot-right">
            <button type="submit" class="btn btn-info" name="Assign">Assign</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </form>
    <?php if (isset($msg))
        echo $msg; ?>
</div> <!-- start assigned work -->
<script>
    function isInputNumber(evt) {
        var ch = String.fromCharCode(evt.which);
        if (!(/[0-9]/.test(ch))) {
            evt.preventDefault();
        }
    }
</script>
