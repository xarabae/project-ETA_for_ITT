<?php
    $db_connect = mysqli_connect('localhost', 'php_user', 'pu', 'test');

   /* if (!$db_connect) {
        echo "Error";
    } else {
        echo "Succesfully connected";
    } */

    $i = "2";

    $str = "SELECT * FROM test1 where f1 = " . $i;

    $query_result = mysqli_query($db_connect, $str);
    
    while($row = mysqli_fetch_row($query_result))
    {
        echo $row[1] . '<br>';
    }
    
    
    
    
    /*$row = mysqli_fetch_row($query_result);
    echo $row[1];
    $row = mysqli_fetch_row($query_result);
    echo $row[1];*/

   /* echo "<!DOCTYPE html>
    <html lang='de'>
        <head>
            <meta charset='utf-8'>
            <link href='styles/style.css' rel='stylesheet'>
            <title>ETA for ITT</title>
        </head>
        <body>
            <h1>ETA for ITT</h1>
            <h2>" . Date("h:i:s") . "</h2>
        </body>
    </html>" */
?>