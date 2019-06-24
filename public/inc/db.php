<?php

//error_reporting(E_ALL);
error_reporting(0);

$localhost = 'localhost';
$user = 'php_user';
$password = 'pu';
$database = 'eta_for_itt';


$db_connect = mysqli_connect($localhozst, $user, $password, $database);

print_r ($db_connect->connect_error);

/*    if (!$db_connect) {
        echo "Error";
    } else {
        echo "Succesfully connected";
    }  */

?>