<?php require_once("header.php"); ?>
<table class="w3-table w3-red">
  <thead>
    <tr>
      <th scope="col">Player ID</th>
      <th scope="col">Athlete</th>
      <th scope="col">Club</th>
    </tr>
  </thead>
  <tbody>
<?php

$sql = "SELECT football_id, football_name,footballclub from Football";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
 
    ?>
    <tr>
     
   <td><?=$row["football_id"]?></td>
    <td><?=$row["football_name"]?></td>
    <td><?=$row["footballclub"]?></td>
    </tr>
 
<?php
  }
} else {
  echo "0 results";
}
   
  ?> 
   </tbody>
</table>

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
                          <label for="editcity<?=$row["city_ID"]?>Name" class="form-label">Athlete's Country</label>
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
