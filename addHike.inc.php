<?php
$db = Database::getInstance();
if(!isset($_SESSION['user_id'])){
    Helper::setErrorMessage('you must be logged in');
    Helper::goTo('.');
}
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

    $difficulty = [
        0 => 'Easy',
        1 => 'Moderate',
        2 => 'Hard',
        3 => 'Expert'


    ];


    if ($db->addHike($date, $name, $location, $description, $distance, $duration, $parking, $elevation, $high, $db->getDifficultyIDByName($difficulty[$difficultyID]))){
        Helper::goTo('hike.php');
    }


}

if (isset($_SESSION['message'])){
    Helper::clearMessage();

}