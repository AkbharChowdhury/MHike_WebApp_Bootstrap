<?php
$current_page = 'login';
$page_title = 'Login';
require_once 'templates/header.php';
require_once 'classes/database.class.php';
require_once 'classes/Helper.class.php';
require_once 'AddHike.inc.php';
?>


<div class="container pt-2">



<?php require_once 'includes/session_message.inc.php'?>

<form class="needs-validation" novalidate method="post" action="">


<div class="form-floating mb-3">
  <input type="text" class="form-control" name="hike_date" id="date" placeholder="name@example.com" required value="<?= $_POST['date'] ?? ''?>">
  <label for="date">Hike Date</label>
  <div class="invalid-feedback">
      Hike date is required
    </div>
</div>


<div class="form-floating mb-3">
  <input type="text" class="form-control" name="hike_name" id="name" placeholder="name@example.com" required value="<?= $_POST['name'] ?? ''?>">
  <label for="name">name</label>
  <div class="invalid-feedback">
    name is required.
    </div>
</div>


<div class="form-floating mb-3">
  <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description" style="height: 100px"></textarea>
  <label for="description">Description</label>
</div>


<div class="form-floating mb-3">
  <input type="text" class="form-control" name="location" id="location" placeholder="name@example.com" required value="<?= $_POST['location'] ?? ''?>">
  <label for="location">location</label>
  <div class="invalid-feedback">
  location is required.
    </div>
</div>


<div class="form-floating mb-3">
  <input type="text" class="form-control" name="distance" id="distance" placeholder="name@example.com" required value="<?= $_POST['distance'] ?? ''?>">
  <label for="distance">Distance (Miles)</label>
  <div class="invalid-feedback">
  distance is required.
    </div>
</div>



<div class="form-floating mb-3">
  <input type="text" class="form-control" name="duration" id="duration" placeholder="name@example.com" required value="<?= $_POST['duration'] ?? ''?>">
  <label for="distance">Duration (Mins)</label>
  <div class="invalid-feedback">
  duration is required.
    </div>
</div>

<div class="form-floating mb-3">
  <select class="form-select" id="parking" name="parking" aria-label="Floating label select parking" required>
    <option selected value="">Select Parking</option>
    <?php foreach($db->getParking() as $row): ?>
        <option value="<?=$row['parking_id']?>"><?=$row['type']?></option>
        <?php endforeach?>
  </select>
  <label for="parking">Parking Available</label>
  <div class="invalid-feedback">
  parking is required.
    </div>
</div>



<div class="form-floating mb-3">
  <input type="text" class="form-control" name="elevation" id="elevation" placeholder="name@example.com" required value="<?= $_POST['elevation'] ?? ''?>" >
  <label for="elevation">elevation gain (ft)</label>
  <div class="invalid-feedback">
  Elevation Gain is required.
    </div>
</div>



<div class="form-floating mb-3">
  <input type="text" class="form-control" name="high" id="high" placeholder="name@example.com" required value="<?= $_POST['high'] ?? ''?>">
  <label for="high">High</label>
  <div class="invalid-feedback">
  high is required.
    </div>
</div>

    <div id="level">

    </div>


  <div class="mt-3">
  <button type="submit" class="btn btn-warning text-capitalize" name="btnAddHike">add hike</button>
  </div>


    <div class="mt-3">
        <button type="button" id="btnCheckDifficulty" class="btn btn-dark text-capitalize">check difficulty</button>
    </div>

</form>
</div>
<?php require_once 'templates/footer.php'; ?>
<script src="script.js"></script>