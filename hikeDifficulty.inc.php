<?php
require_once 'classes/database.class.php';
require_once 'classes/Helper.class.php';


$difficulty = [
    0 => 'Easy',
    1 => 'Moderate',
    2 => 'Hard',
    3 => 'Expert'


];

$colour = [
    'Easy' => 'success',
    'Moderate' => 'warning',
    'Hard' => 'danger',
    'Expert' => 'danger'


];


if (isset($_POST['distance'])  && isset($_POST['elevation'])){
    $distance = doubleval($_POST['distance']);
    $elevation = doubleval($_POST['elevation']);



    $difficultyName = $difficulty[Helper::getDifficultyLevel($distance,$elevation)];
    $difficultColour = $colour[$difficultyName];
    $data = [
        'difficultyName' =>$difficultyName,
        'difficultColour' =>$difficultColour


    ];
    echo  json_encode($data);


}
