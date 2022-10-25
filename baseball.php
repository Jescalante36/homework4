<!doctype html>
<html lang="en">
<head> <?php require_once("header.php"); ?>
    </head>
     <body>
<?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
  case 'Add':
        $sqlAdd = "insert into Baseball (baseball_name, baseballclub) value (?, ?)";
        $stmtAdd = $conn->prepare($sqlAdd);
        $stmtAdd->bind_param("ss", $_POST['ibaseball_name'], $_POST['ibaseballclub']);
        $stmtAdd->execute();   
      echo '<div class="alert alert-success" role="alert">New athlete added.</div>';
  break;
  case 'Edit':
      $sqlEdit = "update Baseball set baseball_name=?, baseballclub=? where baseball_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ssi", $_POST['ibaseball_name'], $_POST['ibaseballclub'], $_POST['iid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Car edited.</div>';
   break;
  }
} else {
  echo "0 results";
    }
  ?> 
<table class="table table-dark table-striped">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addbaseball">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addbaseball" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addInstructorLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addcityLabel">Add Athlete</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="editathlete<?=$row["baseball_id"]?>Name" class="form-label">Athlete Name</label>
                          <input type="text" class="form-control" id="editcity<?=$row["baseball_id"]?>Name" aria-describedby="editcity<?=$row["baseball_id"]?>Help" name="ibaseball_name">
                          <label for="editcity<?=$row["baseball_id"]?>Name" class="form-label">Athlete's Club</label>
                          <input type="text" class="form-control" id="editcity<?=$row["baseball_id"]?>Name" aria-describedby="editcity<?=$row["city_ID"]?>Help" name="ibaseballclub">
                          <div id="editcity<?=$row["baseball_id"]?>Help" class="form-text">Enter the baseball player information.</div>
                        </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <thead>
    <tr>
      <th scope="col">Player ID</th>
      <th scope="col">Athlete</th>
      <th scope="col">Club</th>
    </tr>
  </thead>
    <tbody>
    <?php
$sql = "SELECT * FROM Baseball";
$result = $conn->query($sql);       
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {   
?>
    
    <tr>
        <td><?=$row["baseball_id"]?></td>
        <td><?=$row["baseball_name"]?></td>
        <td><?=$row["baseballclub"]?></td>
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editbaseball<?=$row["CarID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editbaseball<?=$row["CarID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editbaseball<?=$row["baseball_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editbaseball<?=$row["baseball_id"]?>Label">Edit Baseball player</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editbaseball<?=$row["baseball_id"]?>Name" class="form-label">Athlete's Name</label>
                          <input type="text" class="form-control" id="editbaseball<?=$row["baseball_id"]?>Name" aria-describedby="editbaseball<?=$row["baseball_id"]?>Help" name="ibaseball_name" value="<?=$row['baseball_name']?>">
                          <label for="editbaseball<?=$row["baseball_id"]?>Name" class="form-label">Athlete's Club</label>
                          <input type="text" class="form-control" id="editbaseball<?=$row["baseball_id"]?>Name" aria-describedby="editbaseball<?=$row["baseball_id"]?>Help" name="ibaseballclub" value="<?=$row['baseballclub']?>">
                          <div id="editbaseball<?=$row["baseball_id"]?>Help" class="form-text">Enter athlete's information.</div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['baseball_id']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="cid" value="<?=$row["CarID"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <button type="submit" class="btn" onclick="return confirm('Are you sure?')"> Delete </button>
              </form>
            </td>
         <?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
    </tr>
 </tbody>
</table>
 </body>
</html>
