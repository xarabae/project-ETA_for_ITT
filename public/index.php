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
        echo $tabu . "<input name='" . $box_name . "' value='1' type='checkbox' onchange='document.getElementById(".'"filter"'.").click()'";
        
            if (switchCheckbox($box_name)) { echo " checked='checked'"; }
        echo ">" . $tabu . "<label>" . $box_label . "</label><br>\n";
    }
    
    /* setzt den Wert (0/1) der Checkbox und merkt sich beim filtern den angegebenen Wert */
    function switchCheckbox ($box_name) {
    if (!isset($_POST[$box_name])) {
        return FALSE;
        } else {
            return ($_POST[$box_name] != 0);
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
    $where_string = "";

    /* Dynamische Where-String für Prüfungsteil */
    $query_string = "SELECT concat('pt_', ID), ID FROM pruefungsteil";
    $query_result = mysqli_query($db_connect, $query_string);

    while($row = mysqli_fetch_row($query_result))
    {
        if(switchCheckbox($row[0])){
            if($where_string == ""){
                $where_string = "WHERE (pruefungsteil.ID = " . $row[1];
            } else {
                $where_string .= " OR pruefungsteil.ID = " . $row[1];
            }
        }
    }
    if($where_string != "") {
        $where_string .= ")";
    }

    /* Dynamische Where-String für Prüfung */
  //  while($row = mysqli_fetch_row($query_result)){
        if(isset($_POST['jahr'])){
           
            if($where_string == ""){
                $where_string = "WHERE (pruefung.ID = " .  $_POST['jahr'];
            } else {
                if(substr($where_string, -1) == ")"){
                    $where_string .= " AND (pruefung.ID = " .  $_POST['jahr'];
                } else {
                    $where_string .= " OR pruefung.ID = " .  $_POST['jahr'];
                }
            }
        }
    //}
    if($where_string != "" && substr($where_string, -1) != ")") {
         $where_string .= ")";
    }

    /* Dynamische Where-String für Fach */
    $query_string = "SELECT concat('fa_', ID), ID FROM fach";
    $query_result = mysqli_query($db_connect, $query_string);

    while($row = mysqli_fetch_row($query_result))
    {
        if(switchCheckbox($row[0])){
            if($where_string == ""){
                $where_string = "WHERE (fach.ID = " . $row[1];
            } else {
                if(substr($where_string, -1) == ")"){
                    $where_string .= " AND (fach.ID = " . $row[1];
                } else {
                    $where_string .= " OR fach.ID = " . $row[1];
                }
            }
        }
    }
    if($where_string != "" && substr($where_string, -1) != ")") {
        $where_string .= ")";
    }

    /* Dynamische Where-String für Aufgabenart */
    $query_string = "SELECT concat('aa_', ID), ID FROM aufgabenart";
    $query_result = mysqli_query($db_connect, $query_string);

    while($row = mysqli_fetch_row($query_result))
    {
        if(switchCheckbox($row[0])){
            if($where_string == ""){
                $where_string = "WHERE (aufgabenart.ID = " . $row[1];
            } else {
                if(substr($where_string, -1) == ")"){
                    $where_string .= " AND (aufgabenart.ID = " . $row[1];
                } else {
                    $where_string .= " OR aufgabenart.ID = " . $row[1];
                }
            }
        }
    }
    if($where_string != "" && substr($where_string, -1) != ")") {
        $where_string .= ")";
    }
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <title>ETA for ITT</title>
        <meta http-equiv='content-type' content='text/html; charset=utf-8'>
        <link href="style.css" rel="stylesheet">
        <script src="main.js"></script>
    </head>
    <body>
        <div id="heading">
            <h1 class="heading_short">ETA for ITT</h1>         
            <h1 class="heading_long">Examination tasks Administration for IT trainees</h1>
            
        </div>
        <form action="index.php" method="post">
            <div id="sidebar">
                <input id="filter" type="submit" name="submit" value="Filter">
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
                            <label class="labels">Von:</label>
                            <select name="jahr" onchange='document.getElementById("filter").click()'>
                                <?php buildSelectOptions("jahr");?>
                            </select>
                            <br>
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
                <?php
                    echo "<h3 id='where_string'>Where-String: " . $where_string . "</h3>";
                    
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
                    echo "<table>
                    <th id='upperleftcorner'>Prüfung</th>
                    <th>Prüfungsteil</th>
                    <th>Aufgabe</th>
                    <th>Aufgabenart</th>
                    <th>Fach</th>
                    <th id='upperrightcorner'>Thema</th>";
                    if ($query_result !== FALSE){
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
                    }
                    echo '</table>';
                ?>
            </div>
        </div>
    </body>
</html> 
