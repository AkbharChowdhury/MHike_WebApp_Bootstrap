<?php
$current_page = 'login';
$page_title = 'Login';
require_once 'templates/header.php';
require_once 'classes/database.class.php';
require_once 'classes/Helper.class.php';
// require_once 'includes/register.inc.php';
$db = Database::getInstance();

if (isset($_POST['btnAddHike'])){


//    $user_id = $_SESSION['user_id'];
    $date = $_POST['hike_date'];
    $name = $_POST['hike_name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $distance = $_POST['distance'];
    $duration = $_POST['duration'];
    $parking = $_POST['parking'];
    $elevation = $_POST['elevation'];
    $high = $_POST['high'];
    $difficultyID = Helper::getDifficultyLevel(doubleval($distance), doubleval($elevation));



//$sql = "INSERT INTO `Hike`
//                 SET `user_id` = :user_id,
//                    `hike_date` = :hike_date,
//                    `hike_name` = :hike_name,
//                    `description` = :description,
//                    `distance` = :distance,
//                    `duration` = :duration,
//                       `parking_id` = :parking_id,
//                       elevation_gain = :elevation_gain,
//                       high=:high,
//                            difficulty_id=:difficulty_id


//    $db->addData('user_id', $user_id);
//    $db->addData('hike_date', $date);
//    $db->addData('hike_name', $name);
//    $db->addData('description', $description);
//    $db->addData('location', $location);
//
//    $db->addData('distance', $distance);
//    $db->addData('duration', $duration);
//    $db->addData('parking_id', $parking);
//    $db->addData('elevation_gain', $elevation);
//    $db->addData('high', $high);
//    $db->addData('difficulty_id', $difficultyID);


//    $db->addData('user_id', 1);
//    $db->addData('hike_date', );
//    $db->addData('hike_name', $name);
//    $db->addData('description', $description);
//    $db->addData('distance', $distance);
//    $db->addData('duration', $duration);
//    $db->addData('parking_id', $parking);
//    $db->addData('elevation_gain', $elevation);
//    $db->addData('high', $high);
//    $db->addData('difficulty_id', $difficultyID);


    if ($db->addHike($date, $name, $location, $description, $distance, $duration, $parking, $elevation, $high, $difficultyID)){
        Helper::goTo('hike.php');
    }







}

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
<p id="i" class="text-<?=$colour[$a]?>" ><?=$a?? 'qwqw'?></p>
<?php require_once 'templates/footer.php'; ?>
<script>

    $( document ).ready(function() {
        $( "#btnCheckDifficulty" ).click(function() {

            getDifficultyStatus();




        });
    });

    function getDifficultyStatus(){
        $.ajax({url: "hikeDifficulty.inc.php",
            method: 'POST',
            data: {
                distance: $('#distance').val(),
                elevation: $('#elevation').val(),

            },

            success: function(result){
                // $("#div1").html(result);
                let data = JSON.parse(result);
                console.log(data)
                $('#level').html(`<h3 class="text-${data.difficultColour}">${data.difficultyName}</h3>`);
                // console.log(data)
            }});
    }











    $('#distance').keyup(function(){
        var str = $(this).val();
        if( +str || str=='0'){ // validates as a number
            $('#distance').text(str);
        }else{
            $("#distance")[0].value="";
        }
    });




</script>
<script>
        const hikeDate = '#date';
const start = flatpickr(hikeDate, {
  dateFormat: 'Y-m-d', // format for database input
  altInput: true,
  altFormat: 'l J F, Y', // used to display the date and time in a user friendly format
  defaultDate: document.querySelector(hikeDate).value !== '' ? document.querySelector(hikeDate).value : new Date(),
  minDate: 'today'

});
</script>