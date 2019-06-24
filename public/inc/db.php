<?php

//error_reporting(0);

$localhost = 'localhost';
$user = 'php_user';
$password = 'pu';
$database = 'eta_for_itt';

$db = mysqli_connect($localhost, $user, $password, $database);

print_r ($db->connect_error);

if ($db->connect_errno) {
    die("Can't connect.");
} 

?>