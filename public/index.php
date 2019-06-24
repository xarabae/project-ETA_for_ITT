<html>
    <head>
        <title>Sinnvoll</title>
        <meta http-equiv='content-type' content='text/html; charset=utf-8'>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <?php
        require 'inc/db.php';

        if (!isset($_GET["id"])) {$_GET["id"] = 1;}

        $query_string = "SELECT aufgabe.ID, aufgabe.Nummer, aufgabenart.Bezeichnung FROM aufgabe
        INNER JOIN aufgabenart ON aufgabe.Aufgabenart_ID = aufgabenart.ID
        WHERE aufgabe.ID = " . $_GET["id"];
    
        $query_result = mysqli_query($db_connect, $query_string);
        
        echo '<table>';
        while($row = mysqli_fetch_row($query_result))
        {
            echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . '</td></tr>';
        }
        echo '</table>';

        ?>
    </body>
</html>