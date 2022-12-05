<?php
session_start();

if (isset($_SESSION['user_id'])) unset($_SESSION['user_id']);
$_SESSION['message'] = 'You have been logged out';
$_SESSION['msg_type'] = 'success';
$_SESSION['msg_icon'] = 'check-circle-fill';
header('location: .');