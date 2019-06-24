<?php

//error_reporting(0);

$localhost = 'localhost';
$user = 'php_user';
$password = 'pu';
$database = 'eta_for_itt';

$db_connect = mysqli_connect($localhost, $user, $password, $database);

print_r ($db_connect->connect_error);

if ($db_connect->connect_errno) {
    die("Can't connect.");
} 

?>