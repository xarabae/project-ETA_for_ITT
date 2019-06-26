<?php 
    $cbgo = TRUE;
   if (!isset($_POST["test"])) {$_POST["test"] = "";}
   
   checkboxSwitch("check");
 
 function checkboxSwitch ($boxname) {
   if (!isset($_POST[$boxname])) {
       return FALSE;
    } else {
        if ($_POST[$boxname] == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
 }
   
?>

<html>
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
        <input name="test" value="<?php echo $_POST["test"]?>" type="text">
            <div id="sidebar">
                <input id="submit" type="submit" name="submit" value="Filter">
                <hr>
                <button class="accordion" type="button" onclick="accordionFunction('pruefungsteil')">Prüfungsteil</button>
                <div id="pruefungsteil" class="hide">
                    <div class="pruefungsteil">
                     <?php
                            echo "<input name='check' value='0' type='hidden'>";
                            echo "<input name='check' value='1'";
                                if (checkboxSwitch("check")) { echo " checked='checked'"; }
                            echo " type='checkbox'><label>GA1</label><br>";
                        ?>
                        
                        <br>
                        <!--<input id="ga2" name="check_list[]" value="GA2" type="checkbox">
                        <label>GA2</label>
                        <br>
                        <input id="wiso" name="check_list[]" value="WISO" type="checkbox">
                        <label>WISO</label>
                        <br>-->
                    </div>
                </div>
                <hr>
                <button class="accordion" type="button" onclick="accordionFunction('pruefung')">Prüfung</button>
                <div id="pruefung" class="hide">
                    <div class="pruefung">
                        <input id="one_year" name="year" type="radio">
                        <div>
                            <label>Jahr:</label>
                            <select></select>
                        </div>
                        <input id="from_to_year" name="year" type="radio">
                        <div>
                            <label>Von:</label>
                            <select></select>
                            <br>
                            <label>Bis:</label>
                            <select></select>
                        </div>                        
                    </div>
                </div>
                <hr>
                <button class="accordion" type="button" onclick="accordionFunction('fach')">Fach</button>
                <div id="fach" class="hide">
                    <div class="fach"> 
                        <input id="ae" name="ae" value="<?php echo $_POST["ae"]?>" type="checkbox">
                        <label>Anwendungsentwicklung</label>
                        <br>
                        <input id="it" name="check_list[]" value="IT-Systeme" type="checkbox">
                        <label>IT-Systeme</label>
                        <br>
                        <input id="oug" name="check_list[]" value="Organisation und Geschäftsproz." type="checkbox">
                        <label>Organisation und Geschäftsproz.</label>
                        <br>
                        <input id="wug" name="check_list[]" value="Wirtschaft und Gesellschaft" type="checkbox">
                        <label>Wirtschaft und Gesellschaft</label>
                        <br>
                    </div>
                </div>
                <hr>
                <button class="accordion" type="button" onclick="accordionFunction('aufgabenart')">Aufgabenart</button>
                <div id="aufgabenart" class="hide">
                    <div class="aufgabenart">
                        <input id="qa" name="check_list[]" value="Frage-Antwort" type="checkbox">
                        <label>Frage-Antwort</label>
                        <br>
                        <input id="mc" name="check_list[]" value="Multiple Choice" type="checkbox">
                        <label>Multiple Choice</label>
                        <br>
                        <input id="ass" name="check_list[]" value="Zuordnen" type="checkbox">
                        <label>Zuordnen</label>
                        <br>
                        <input id="calc" name="check_list[]" value="Rechnen" type="checkbox">
                        <label>Rechnen</label>
                        <br>
                        <input id="comp" name="check_list[]" value="Vervollständigen" type="checkbox">
                        <label>Vervollständigen</label>
                        <br>
                        <input id="ex" name="check_list[]" value="Erläutern" type="checkbox">
                        <label>Erläutern</label>
                        <br>
                    </div>
                </div>
            </div>
        </form>
        <div id="content">
            <?php
            require 'inc/db.php';

            if(isset($_POST['submit'])) {
                //to run PHP script on submit
                if(!empty($_POST['check_list'])) {
                    // Loop to store and display values of individual checked checkbox.
                    //foreach($_POST['check_list'] as $selected){
                    //    echo $selected . "</br>"; 
                   // }
                }
            } 

            /* if (!isset($_GET["id"])) {$_GET["id"] = 1;}
                WHERE aufgabe.ID = " . $_GET["id"]; */

            $query_string = "SELECT aufgabe.Nummer FROM aufgabe";
        
            $query_result = mysqli_query($db_connect, $query_string);
            
            echo '<table>';
            while($row = mysqli_fetch_row($query_result))
            {
                echo "<tr><td>" . $row[0] . '</td></tr>';
            }
            echo '</table>';
            ?>
        </div>
    </body>
</html> 