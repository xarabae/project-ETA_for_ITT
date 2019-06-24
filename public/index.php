<?php
require 'inc/db.php';

$localhost = 'localhost';
$user = 'php_user';
$password = 'pu';
$database = 'eta_for_itt';


$db_connect = mysqli_connect($localhost, $user, $password, $database);

    if (!$db_connect) {
        echo "Error";
    } else {
        echo "Succesfully connected";
    } 


?>