<H1> Please select any of the provided sports to add new athletes</h1>
<?php require_once("header.php"); ?>


<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">City ID</th>
      <th scope="col"></th>
      <th scope="col">Name</th>
    </tr>
  </thead>
  <tbody>
<?php

$sql = "SELECT city_ID,Abbreviation, fullname from City order by city_ID";
$result = $conn->query($sql);




?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
        $sqlAdd = "insert into City (Abbreviation, fullname) value (?, ?)";
        $stmtAdd = $conn->prepare($sqlAdd);
        $stmtAdd->bind_param("ss", $_POST['icityabrv'], $_POST['icityname']);
        $stmtAdd->execute();   
      echo '<div class="alert alert-success" role="alert">New City added.</div>';
      break;

      case 'Delete':
        $sqlDelete = "Delete From City where city_ID=?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $_POST['iid']);
        $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">City deleted.</div>';
      break;
     
      
      case 'Edit':
      $sqlEdit = "update City set Abbreviation=?, fullname=? where city_ID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ssi", $_POST['iFirstName'], $_POST['iLastName'], $_POST['iid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">City edited.</div>';
      break;


   }
}
     
?>




<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInstructor">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addInstructor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addInstructorLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addcityLabel">Add Athlete</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="editcity<?=$row["city_ID"]?>Name" class="form-label">Athlete Name</label>
                          <input type="text" class="form-control" id="editcity<?=$row["city_ID"]?>Name" aria-describedby="editcity<?=$row["city_ID"]?>Help" name="icityabrv">
                          <label for="editcity<?=$row["city_ID"]?>Name" class="form-label">Country</label>
                          <input type="text" class="form-control" id="editcity<?=$row["city_ID"]?>Name" aria-describedby="editcity<?=$row["city_ID"]?>Help" name="icityname">
                          <div id="editcity<?=$row["city_ID"]?>Help" class="form-text">Enter the cities info.</div>
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

<?php

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["city_ID"]?></td>
            <td><?=$row["Abbreviation"]?></td>
            <td><?=$row["fullname"]?></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editcity<?=$row["city_ID"]?>" style = "background-color:white;">
                Edit
              </button>
              <div class="modal fade" id="editcity<?=$row["city_ID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editcity<?=$row["city_ID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editcity<?=$row["city_ID"]?>Label">Edit City</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editcity<?=$row["city_ID"]?>Name" class="form-label">First Name</label>
                          <input type="text" class="form-control" id="editcity<?=$row["city_ID"]?>Name" aria-describedby="editcity<?=$row["city_ID"]?>Help" name="iFirstName" value="<?=$row['Abbreviation']?>">
                          <label for="editcity<?=$row["city_ID"]?>Name" class="form-label">Last Name</label>
                          <input type="text" class="form-control" id="editcity<?=$row["city_ID"]?>Name" aria-describedby="editcity<?=$row["city_ID"]?>Help" name="iLastName" value="<?=$row['fullname']?>">
                          <div id="editcity<?=$row["city_ID"]?>Help" class="form-text">Enter the cities Full name/Abbreviation.</div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['city_ID']?>">
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
                <input type="hidden" name="iid" value="<?=$row["city_ID"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <button type="submit" class="btn" onclick="return confirm('Are you sure?')"style = "background-color:white;"> Delete </button>
              </form>
            </td>
          </tr>
          
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>

</html>
