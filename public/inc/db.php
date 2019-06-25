<?php

//error_reporting(0);

$localhost = 'localhost';
$user = 'php_user';
$password = 'pu';
$database = 'eta_for_itt';

/* database connect */
$db_connect = mysqli_connect($localhost, $user, $password, $database);
print_r ($db_connect->connect_error);
if ($db_connect->connect_errno) {
    die("Can't connect.");
} 

/* change character set to utf8 */
if (!$db_connect->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $db_connect->error);
    exit(); 
}

?>