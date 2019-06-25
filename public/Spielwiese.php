<html>
    <head>
        <title>Spielwiese</title>
        <meta http-equiv='content-type' content='text/html; charset=utf-8'>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
<?php
    if (!isset($_GET["id"])) {$_GET["id"] = 1;}
    $db_connect = mysqli_connect('localhost', 'php_user', 'pu', 'eta_for_itt');

   /* if (!$db_connect) {
        echo "Error";
    } else {
        echo "Succesfully connected";
    } */

    $str = "SELECT a.ID, a.Nummer, aa.Bezeichnung FROM aufgabe a
    INNER JOIN aufgabenart aa ON a.Aufgabenart_ID = aa.ID
    where a.ID = " . $_GET["id"];


    $query_result = mysqli_query($db_connect, $str);
    
    echo '<table>';
    while($row = mysqli_fetch_row($query_result))
    {
        echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . '</td></tr>';
    }
    echo '</table>';


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

<script> 
// Accordions
function accorfionFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

</script>

</body>
</html>