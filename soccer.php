<!doctype html>
<html lang="en">
<head> <?php require_once("header.php"); ?>
    </head>
     <body>
<?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
  case 'Add':
        $sqlAdd = "insert into Soccer (soccer_name, soccerclub) value (?, ?)";
        $stmtAdd = $conn->prepare($sqlAdd);
        $stmtAdd->bind_param("ss", $_POST['isoccer_name'], $_POST['isoccerclub']);
        $stmtAdd->execute();   
      echo '<div class="alert alert-success" role="alert"> Athlete added.</div>';
  break;
  case 'Edit':
      $sqlEdit = "update Soccer set soccer_name=?, soccerclub=? where soccer_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ssi", $_POST['isoccer_name'], $_POST['isoccerclub'], $_POST['iid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Athlete edited.</div>';
   break;
   case 'Delete':
        $sqlDelete = "Delete From Soccer where soccer_id=?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $_POST['cid']);
        $stmtDelete->execute();
   echo '<div class="alert alert-success" role="alert">Athlete deleted.</div>';
  }
} else {
  echo "";
    }
  ?> 
<table class="table table-dark table-striped">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsoccer">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addsoccer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addsoccerLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addsoccerLabel">Add Athlete</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="editathlete<?=$row["soccer_id"]?>Name" class="form-label">Athlete Name</label>
                          <input type="text" class="form-control" id="editsoccer<?=$row["soccer_id"]?>Name" aria-describedby="editsoccer<?=$row["soccer_id"]?>Help" name="isoccer_name">
                          <label for="editathlete<?=$row["soccer_id"]?>Name" class="form-label">Athlete's Club</label>
                          <input type="text" class="form-control" id="editsoccer<?=$row["soccer_id"]?>Name" aria-describedby="editathlete<?=$row["soccer_id"]?>Help" name="isoccerclub">
                          <div id="editathlete<?=$row["soccer_id"]?>Help" class="form-text">Enter the soccer player information.</div>
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
$sql = "SELECT * FROM Soccer";
$result = $conn->query($sql);       
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {   
?>
    
    <tr>
        <td><?=$row["soccer_id"]?></td>
        <td><?=$row["soccer_name"]?></td>
        <td><?=$row["soccerclub"]?></td>
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editsoccer<?=$row["soccer_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editsoccer<?=$row["soccer_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editsoccer<?=$row["soccer_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editsoccer<?=$row["soccer_id"]?>Label">Edit soccer player</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editsoccer<?=$row["soccer_id"]?>Name" class="form-label">Athlete's Name</label>
                          <input type="text" class="form-control" id="editsoccer<?=$row["soccer_id"]?>Name" aria-describedby="editsoccer<?=$row["soccer_id"]?>Help" name="isoccer_name" value="<?=$row['soccer_name']?>">
                          <label for="editsoccer<?=$row["soccer_id"]?>Name" class="form-label">Athlete's Club</label>
                          <input type="text" class="form-control" id="editsoccer<?=$row["soccer_id"]?>Name" aria-describedby="editsoccer<?=$row["soccer_id"]?>Help" name="isoccerclub" value="<?=$row['soccerclub']?>">
                          <div id="editsoccer<?=$row["soccer_id"]?>Help" class="form-text">Enter athlete's information.</div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['soccer_id']?>">
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
                <input type="hidden" name="cid" value="<?=$row["soccer_id"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <button type="submit" class="btn btn-light" onclick="return confirm('Are you sure?')"> Delete </button>
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
