<?php
$db = Database::getInstance();
if ($_POST) {

    
        // if there are no errors in form then redirect and insert values

        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $email = trim(trim($_POST['email']));
        $password = trim($_POST['password']);

        if ($db->UserEmailExists($email)) {
            Helper::setErrorMessage($email. ' already exists!');
            return;
        }

        $db->addData('firstname', $firstname)
            ->addData('lastname', $lastname)
            ->addData('email', $email)
            ->addData('password', $password);

            if($db->addUser()){

                $_SESSION['message'] = 'Your account has been created';
                $_SESSION['msg_type'] = 'success';
                $_SESSION['msg_icon'] = 'check-circle-fill';
                Helper::goTo('index.php');

            }
        Helper::setErrorMessage('There was an error creating your account');

    
}
