<?php 
    require 'inc/db.php';

    if (!isset($_POST["test"])) {$_POST["test"] = "";}   


    /* Aufbau der Checkboxen */
    function buildCheckbox ($box_name, $box_label, $tabs){
        $tabu = "\n";
        for($i = 0; $i < $tabs; $i++){
            $tabu .= "\t";
        }
        echo $tabu . "<!-- Checkbox " . $box_name . " steht auf " . switchCheckbox($box_name) . " -->";
        echo $tabu . "<input name='" . $box_name . "' value='0' type='hidden'>";
        echo $tabu . "<input name='" . $box_name . "' value='1' type='checkbox'";
            if (switchCheckbox($box_name)) { echo " checked='checked'"; }
        echo ">" . $tabu . "<label>" . $box_label . "</label><br>\n";
    }
    
    /* setzt den Wert (0/1) der Checkbox und merkt sich beim filtern den angegebenen Wert */
    function switchCheckbox ($box_name) {
    if (!isset($_POST[$box_name])) {
        return FALSE;
        } else {
            if ($_POST[$box_name] == 0) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    /* Übergibt den $query_string an die funktion, die die Datenbank-Werte an buildCheckbox() weitergibt*/
    function getDataForCheckbox($tabs, $query_string){
        global $db_connect;
        $query_result = mysqli_query($db_connect, $query_string);
        
        while($row = mysqli_fetch_row($query_result))
        {
            buildCheckbox($row[0],$row[1],$tabs);
        }
    }

    /* Aufbau der Dropdownlisten */
    function buildSelectOptions($div_name){
        global $db_connect;
        if(!isset($_POST[$div_name])){
            $_POST[$div_name] = 0;
        }

        $query_string = "SELECT ID, concat(Halbjahr, ' ', Jahr) FROM `pruefung`";
        $query_result = mysqli_query($db_connect, $query_string);

        while($row = mysqli_fetch_row($query_result))
        {
            echo "\n <option value='" . $row[0] . "'";
            if ($_POST[$div_name] == $row[0]) { echo " selected='selected'"; }
            echo ">" . $row[1] . "</option>";
        }
    }

    /* Aufbau $Where-String */
    $where_string = "WHERE TRUE ";

    if(switchCheckbox("pt_1")){
        $where_string .= "AND pruefungsteil.ID = 1 ";
    }
    if(switchCheckbox("aa_1")){
        $where_string .= "AND aufgabenart.ID = 1 ";
    }
    echo $where_string;

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <title>ETA for ITT</title>
        <meta http-equiv='content-type' content='text/html; charset=utf-8'>
        <link href="style.css" rel="stylesheet">
        <script src="inc/main.js"></script>
    </head>
    <body>
        <div id="heading">
            <h1 class="heading_short">ETA for ITT</h1>         
            <h1 class="heading_long">Examination tasks Administration for IT trainees</h1>
            
        </div>
        <form action="index.php" method="post">
            <div id="sidebar">
                <input id="submit" type="submit" name="submit" value="Filter">
                <hr>
                <button class="accordion" type="button" onclick="accordionFunction('pruefungsteil')">Prüfungsteil</button>
                <div id="pruefungsteil" class="hide">
                    <div class="pruefungsteil">
                        <?php
                            getDataForCheckbox(6,"SELECT concat('pt_', ID), Bezeichnung FROM pruefungsteil");
                        ?>
                    </div>
                </div>
                <hr>
                <button class="accordion" type="button" onclick="accordionFunction('pruefung')">Prüfung</button>
                <div id="pruefung" class="hide">
                    <div class="pruefung">
                        <div>
                            <label>Von:</label>
                            <select name="von_jahr">
                                <?php buildSelectOptions("von_jahr");?>
                            </select>
                            <br>
                            <label>Bis:</label>
                            <select name="bis_jahr">
                                <?php buildSelectOptions("bis_jahr");?> 
                            </select>
                        </div>                        
                    </div>
                </div>
                <hr>
                <button class="accordion" type="button" onclick="accordionFunction('fach')">Fach</button>
                <div id="fach" class="hide">
                    <div class="fach"> 
                         <?php
                            getDataForCheckbox(6, "SELECT concat('fa_', ID), Bezeichnung FROM fach");
                        ?>
                    </div>
                </div>
                <hr>
                <button class="accordion" type="button" onclick="accordionFunction('aufgabenart')">Aufgabenart</button>
                <div id="aufgabenart" class="hide">
                    <div class="aufgabenart">
                        <?php
                            getDataForCheckbox(6, "SELECT concat('aa_', ID), Bezeichnung FROM aufgabenart");
                        ?>
                    </div>
                </div>
            </div>
        </form>
        <div id="content">
            <div class="ausgabe">
                <table>
                    <th>Prüfung</th>
                    <th>Prüfungsteil</th>
                    <th>Aufgabe</th>
                    <th>Aufgabenart</th>
                    <th>Fach</th>
                    <th>Thema</th>
                </table>
            </div>
            <?php

                $query_string = "SELECT 
                concat(pruefung.Halbjahr, ' ', pruefung.Jahr),
                pruefungsteil.Bezeichnung, 
                aufgabe.Nummer, 
                aufgabenart.Bezeichnung,
                fach.Bezeichnung,
                thema.Bezeichnung
                FROM aufgabe
                INNER JOIN pruefungsteil ON aufgabe.Pruefungsteil_ID = pruefungsteil.ID
                INNER JOIN aufgabenart ON aufgabe.Aufgabenart_ID = aufgabenart.ID
                INNER JOIN pruefung ON aufgabe.Pruefungs_ID = pruefung.ID
                INNER JOIN thema ON aufgabe.Thema_ID = thema.ID
                INNER JOIN fach ON thema.Fach_ID = fach.ID " 
                . $where_string;

                $query_result = mysqli_query($db_connect, $query_string);
                echo '<table>';
                while($row = mysqli_fetch_row($query_result))
                {
                    echo "<tr><td>" . $row[0] . 
                    "</td><td>" . $row[1] . 
                    "</td><td>" . $row[2] . 
                    "</td><td>" . $row[3] .
                    "</td><td>" . $row[4] .
                    "</td><td>" . $row[5] .
                    '</td></tr>';
                }
                echo '</table>';
            ?>
        </div>
    </body>
</html> 