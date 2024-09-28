<?php
include('includes/dheader.php');
include('../dbConnection.php');
session_start();

if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href='login.php'; </script>";
}
?>
<div class="col-sm-9 col-md-10 mt-5 text-center">
    <!-- Table -->
    <!-- review_id request_id empEmail rating comments created_at -->

    <p class="bg-dark text-white p-2">List of Complete Work</p>
    <?php
    $sql = "SELECT * FROM technician_reviews";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo '<table class="table">
            <thead>
                <tr>
                    <th scope="col">review_id</th>
                    <th scope="col">request_id</th>
                    <th scope="col">empEmail</th>
                    <th scope="col">rating</th>
                    <th scope="col">comments</th>
                    <th scope="col">created_at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';
        while($row = $result->fetch_assoc()){
            echo '<tr>';
            echo '<th scope="row">'.$row["review_id"].'</th>';
            echo '<td>'. $row["request_id"].'</td>';
            echo '<td>'.$row["empEmail"].'</td>';
            echo '<td>'.$row["rating"].'</td>';
            echo '<td>'.$row["comments"].'</td>';
            echo '<td>'.$row["created_at"].'</td>';
            
            echo '<td>
                <form action="" method="POST" class="d-inline">
                    <input type="hidden" name="id" value='. $row["review_id"] .'>
                    <button type="submit" class="btn btn-danger" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button>
                </form>
            </td>';
            echo '</tr>';
        }
        echo '</tbody>
        </table>';
    } else {
        echo "0 Result";
    }

    if(isset($_REQUEST['delete'])){
        $sql = "DELETE FROM technician_reviews WHERE review_id = {$_REQUEST['id']}";
        if($conn->query($sql) === TRUE){
            // Refresh the page after deleting the record
            echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
        } else {
            echo '<div class="alert alert-danger mt-2" role="alert"> Unable to Delete Data</div>';
        }
    }
    ?>

<?php 
if(isset($_REQUEST['delete'])){
    $stmt = $conn->prepare("DELETE FROM technician_reviews WHERE review_id = ?");
    $stmt->bind_param("i", $_REQUEST['id']); // Assuming u_login_id is an integer
    if($stmt->execute() === TRUE){
        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
    } else {
        echo '<div class="alert alert-danger mt-2" role="alert"> Unable to Delete Data</div>';
    }
    $stmt->close();
}
?>
<?php
include('includes/dfooter.php');
?>