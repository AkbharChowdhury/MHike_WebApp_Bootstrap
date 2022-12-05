<?php
$db = Database::getInstance();
if ($_POST) {
  

        $email = trim($_POST['email']);
        $password = sha1(trim($_POST['password']));
        $db->addData('email', $email)->addData('password', $password);
        if ($db->databaseContainsUser()) {
            // echo $db->getUserID($email);

            $_SESSION['user_id'] = $db->getUserID($email);
            Helper::goTo('hike.php');
            return;
        } 
        unset($_POST);
}