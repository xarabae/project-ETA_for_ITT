<?php
require 'inc/db.php';

$str = "SELECT * FROM fach";

$query_result = mysqli_query($db, $str);

while($row = mysqli_fetch_row($query_result))
{
    echo $row[1] . '<br>';
}

?>