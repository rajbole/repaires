<?php
if (isset($_REQUEST['view'])) {
    $sql = "SELECT * FROM submitrequest_tb WHERE request_id = {$_REQUEST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// Fetch the technicians from technician_tb to populate the dropdown
$sql = "SELECT empid, empName, empMobile, empSpecial, empEmail FROM technician_tb";
$resultTechnicians = $conn->query($sql);

// Store technician data in an array
$technicians = [];
if ($resultTechnicians->num_rows > 0) {
    while ($rowTechnician = $resultTechnicians->fetch_assoc()) {
        $technicians[] = $rowTechnician; // Store each technician's details
    }
}

// Check if the 'Delete' button was clicked and 'id' is set
if (isset($_REQUEST['Delete']) && isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $sql = "DELETE FROM submitrequest_tb WHERE request_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo '<meta http-equiv="refresh" content="0;URL=?closed" />';
        } else {
            echo '<div class="alert alert-warning mt-2" role="alert"> Unable To Delete </div>';
        }
    }
}

// Handle the form submission to assign a technician
if (isset($_REQUEST['Assign'])) {
    if (empty($_REQUEST['request_id']) || empty($_REQUEST['request_info']) || empty($_REQUEST['requestername']) || empty($_REQUEST['address1']) || empty($_REQUEST['address2']) || empty($_REQUEST['requestercity']) || empty($_REQUEST['requesterstate']) || empty($_REQUEST['requesterzip']) || empty($_REQUEST['requesteremail']) || empty($_REQUEST['requestermobile']) || empty($_REQUEST['assigntech']) || empty($_REQUEST['techemail']) || empty($_REQUEST['inputdate'])) {
        $msg = '<div class="alert alert-warning mt-2" role="alert"> All Fields Require </div>';
    } else {
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
        $rtmail = $conn->real_escape_string($_REQUEST['techemail']);
        $rdate = $conn->real_escape_string($_REQUEST['inputdate']);

        $sql = "INSERT INTO assignwork_tb (request_id, request_info, requester_name, requester_add1, requester_add2, requester_city, requester_state, requester_pin, requester_email, requester_mobile, assign_tech, empEmail, assign_date) VALUES ('$rid', '$rinfo', '$rname', '$radd1', '$radd2', '$rcity', '$rstate', '$rpin', '$remail', '$rmobile', '$rtech', '$rtmail', '$rdate')";

        if ($conn->query($sql) === TRUE) {
            $msg = '<div class="alert alert-success mt-2" role="alert"> Assigned Successfully </div>';
        } else {
            $msg = '<div class="alert alert-danger mt-2" role="alert"> Unable to Assign: ' . $conn->error . '</div>';
        }
    }
}
?>

<div class="col-sm-6 mt-5 jumbotron"> <!-- start assigned work -->
    <form action="" method="POST">
        <h5 class="text-center">Assign Work Order Request</h5>

        <!-- Other form fields -->
        <!-- Request ID -->
        <div class="form-group">
            <label for="request_id">Request ID</label>
            <input type="text" class="form-control" id="request_id" name="request_id"
                value="<?php if (isset($row['request_id'])) echo $row['request_id']; ?>" readonly>
        </div>

        <!-- Request Info -->
        <div class="form-group">
            <label for="request_info">Request Info</label>
            <input type="text" class="form-control" id="request_info" name="request_info"
                value="<?php if (isset($row['request_info'])) echo $row['request_info']; ?>">
        </div>

        <!-- Name -->
        <div class="form-group">
            <label for="requestername">Name</label>
            <input type="text" class="form-control" id="requestername" name="requestername"
                value="<?php if (isset($row['requester_name'])) echo $row['requester_name']; ?>">
        </div>

        <!-- Address Fields -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="address1">Address 1</label>
                <input type="text" class="form-control" id="address1" name="address1"
                    value="<?php if (isset($row['requester_add1'])) echo $row['requester_add1']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="address2">Address 2</label>
                <input type="text" class="form-control" id="address2" name="address2"
                    value="<?php if (isset($row['requester_add2'])) echo $row['requester_add2']; ?>">
            </div>
        </div>

        <!-- City, State, and Zip -->
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="requestercity">City</label>
                <input type="text" class="form-control" id="requestercity" name="requestercity"
                    value="<?php if (isset($row['requester_city'])) echo $row['requester_city']; ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="requesterstate">State</label>
                <input type="text" class="form-control" id="requesterstate" name="requesterstate"
                    value="<?php if (isset($row['requester_state'])) echo $row['requester_state']; ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="requesterzip">Zip Code</label>
                <input type="text" class="form-control" id="requesterzip" name="requesterzip"
                    onkeypress="isInputNumber(event)"
                    value="<?php if (isset($row['requester_pin'])) echo $row['requester_pin']; ?>">
            </div>
        </div>

        <!-- Email and Mobile -->
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="requesteremail">Email</label>
                <input type="email" class="form-control" id="requesteremail" name="requesteremail"
                    value="<?php if (isset($row['requester_email'])) echo $row['requester_email']; ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="requestermobile">Mobile</label>
                <input type="text" class="form-control" id="requestermobile" name="requestermobile"
                    onkeypress="isInputNumber(event)"
                    value="<?php if (isset($row['requester_mobile'])) echo $row['requester_mobile']; ?>">
            </div>
        </div>

        <!-- Technician Dropdown -->
        <div class="form-group col-md-9">
            <label for="assigntech">Assign Technician</label>
            <select class="form-control" id="assigntech" name="assigntech">
                <option value="">Select Technician</option>
                <?php foreach ($technicians as $technician) {
                    $techDetails = $technician['empName'] . " - " . $technician['empMobile'] . " - " . $technician['empSpecial'];
                    echo "<option value='" . $techDetails . "'>" . $techDetails . "</option>";
                } ?>
            </select>
        </div>

        <!-- Technician Email Dropdown -->
        <div class="form-group col-md-9">
            <label for="techemail">Assign Technician Email</label>
            <select class="form-control" id="techemail" name="techemail">
                <option value="">Select Technician Email</option>
                <?php foreach ($technicians as $technician) {
                    $techEmail = $technician['empEmail'];
                    echo "<option value='" . $techEmail . "'>" . $techEmail . "</option>";
                } ?>
            </select>
        </div>

        <!-- Date -->
        <div class="form-group col-md-6">
            <label for="inputDate">Date</label>
            <input type="date" class="form-control" id="inputDate" name="inputdate">
        </div>

        <!-- Buttons -->
        <div class="float-right">
            <button type="submit" class="btn btn-info" name="Assign">Assign</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </form>

    <?php if (isset($msg)) echo $msg; ?>
</div> <!-- End of assigned work -->

<script>
    function isInputNumber(evt) {
        var ch = String.fromCharCode(evt.which);
        if (!(/[0-9]/.test(ch))) {
            evt.preventDefault();
        }
    }
</script>