<?php
include('includes/dheader.php');
include('../dbConnection.php');
?>
<div class="col-sm-9 col-md-10 mt-5 text-center">
  <!--Table-->
  <p class=" bg-dark text-white p-2">List of Requesters</p>
  <?php
    $sql = "SELECT * FROM user_tb";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
 echo '<table class="table">
  <thead>
   <tr>
    <th scope="col">User ID</th>
    <th scope="col">Name</th>
    <th scope="col">Email</th>
    <th scope="col">Action</th>
   </tr>
  </thead>
  <tbody>';
  while($row = $result->fetch_assoc()){
   echo '<tr>';
    echo '<th scope="row">'.$row["u_login_id"].'</th>';
    echo '<td>'. $row["u_name"].'</td>';
    echo '<td>'.$row["u_email"].'</td>';
    echo '<td><form action="edituser.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["u_login_id"] .'><button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="fas fa-pen"></i></button></form>  
    <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["u_login_id"] .'><button type="submit" class="btn btn-danger" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
   </tr>';
  }
  
 echo '</tbody>
 </table>';
} else {
  echo "0 Result";
}
if(isset($_REQUEST['delete'])){
  $sql = "DELETE FROM user_tb WHERE u _login_id = {$_REQUEST['id']}";
  if($conn->query($sql) === TRUE){
    // echo "Record Deleted Successfully";
    // below code will refresh the page after deleting the record
    echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
      echo '<div class="alert alert-danger mt-2" role="alert"> Unable to Delete Data</div>';
    }
  }
?>
</div>
</div>
<div><a class="btn btn-danger box" href="insertuser.php"><i class="fas fa-plus fa-2x"></i></a>
</div>
</div>
<?php
include('includes/dfooter.php');
?>