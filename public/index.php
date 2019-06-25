<html>
    <head>
        <title>ETA for ITT</title>
        <meta http-equiv='content-type' content='text/html; charset=utf-8'>
        <link href="style.css" rel="stylesheet">
        <script src="scripts/main.js"></script>
    </head>
    <body>
        <div id="heading">
            <h1 class="heading_short">ETA for ITT</h1>         
            <h1 class="heading_long">Examination tasks Administration for IT trainees</h1>
        </div>
        <div id="sidebar">
            <button id="submit_filter" type = "submit">Filter</button>
            <button class="accordion" onclick="accordionFunction(id)"> </button>
            <div></div>
        </div>
        <div id="content">
            <?php
            require 'inc/db.php';

            /* if (!isset($_GET["id"])) {$_GET["id"] = 1;}
                WHERE aufgabe.ID = " . $_GET["id"]; */

            $query_string = "SELECT aufgabe.Nummer FROM aufgabe";
        
            $query_result = mysqli_query($db_connect, $query_string);
            
            echo '<table>';
            while($row = mysqli_fetch_row($query_result))
            {
                echo "<tr><td>" . $row[0] . '</td><td>' . $row[1] . '</td></tr>';
            }
            echo '</table>';
            ?>
        </div>
    </body>
</html> 