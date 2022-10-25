<?php require_once("header.php"); ?>
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
