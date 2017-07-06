<?php
session_start();
require_once '../controller/controller.php';
$meinObjekt = new Controller(); // neues Objekt der Klasse Controller instanzieren
$fuelleList = $meinObjekt->ausgabeAlleProjekte();  //Methode ausgabeAlleProjekte() 
$fuelleList2 = $meinObjekt->ausgabeAlleAufgabendesMitarbeiters($_SESSION["ID"]);
if (isSet($_SESSION["username"])) {
    echo "<div class=\"login\">Angemeldeter User: <strong>" . $_SESSION["username"] . " User ID: " . $_SESSION["ID"] . "</strong></div>";
} else {
    echo "<div class=\"login\">Sie sind noch nicht angemeldet <a href=\"main.php\"><strong>login</strong></a></div>";
}
?>
<!DOCTYPE html>  
<html>  
    <head>  
        <title></title>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
        <style> .fright {float:right;}</style>
    </head>  
    <body>  
        <div class="container"> 
            <?php require_once 'navbar.php'; ?>
            <h3 align="center">Übersicht aller Aufgaben des Mitarbeiters <strong>
                    <?php
                    if (isset($_SESSION["ID"])) {
                        echo '' . $_SESSION["vorname"] . " " . $_SESSION["nachname"] . '';
                    } else {
                        header("Location: main.php");
                    }
                    ?>
                </strong>
            </h3>  
            <br />  
            <div class="table-responsive">  
                <table id="tabledata1" class="table table-striped table-bordered">  
                    <thead>  
                        <tr>  
                            <td>AufgabenID</td>  
                            <td>Aufgabename</td>  
                            <td>Zeit</td>  
                            <td>Status</td>  
                            <td>Zeitstart</td>  
                            <td>Zeitstop</td>  
                            <td>Aufgabe editieren</td>  
                        </tr>  
                    </thead>  
                    <script>
                        $("#start").click(function () {
                            $("#start").removeAttr('disabled');
                        });
                    </script>

                    <?php
                    $max1 = count($fuelleList2);
                    for ($i = 0; $i < $max1; $i++) {
                        $button_start = '<input id="start" type="submit" class="btn btn-primary btn-sm" value="start" id="hide" name="start' . $i . '">';
                        $button_stop = '<input type="submit" class="btn btn-primary btn-sm" value="stop" id="hide" name="stop' . $i . '">';

                        if (isset($_POST['start' . $i . ''])) {
                            $date_start = date('Y-m-d H:i:s');
                            $button_start = "";
                            $_SESSION['start' . $i . ''] = $date_start;
                        } else {
                            echo "";
                        }

                        if (isset($_POST['stop' . $i . ''])) {
                            $date_stop = date('Y-m-d H:i:s');
                            $button_stop = "";
                            $_SESSION['stop' . $i . ''] = $date_stop;
                        } else {
                            echo "";
                        }
                        $aufgabenID[$i] = $fuelleList2[$i]["PKAufgabenID"]; //speichere die Aufgaben ID  
                        $fuelleList3[] = $meinObjekt->getZeitenSummiertData($_SESSION["ID"], $aufgabenID[$i]); // Summe der Zeiten der Aufgabe wird ermittelt und in Stunden,Minuten,Sekunden 

                        if ($fuelleList2[$i]["status"] != "stillgelegt") { // falls status stillgelegt, wird Aufgabe nicht mehr gelistet
                            echo '  
                               <tr> <td>' . $fuelleList2[$i]["PKAufgabenID"] . '</td> 
                                    <td>' . $fuelleList2[$i]["aufgabenname"] . '</td> 
                                    <td>' . $fuelleList3[$i][0]["SummeZeit"] . '</td>  
                                    <td>' . $fuelleList2[$i]["status"] . '</td>  
                                    <td>
                            <form  method="POST"><input type="hidden" name="start" value="' . $i . '">' . $button_start . ' 
                                    </form>
                            <div id="show">';

                            echo '</div>
                            </td>
                                   <td>
                              <form  method="POST"><input type="hidden" name="stop" value="' . $i . '">' . $button_stop . ' 
                                    </form>
                            <div id="show">';
                            echo '</div>
                            </td>
                            
                            <td>   <a href="item_bearbeiten.php?id=' . $fuelleList2[$i]["PKAufgabenID"] . '"><button type="button" class="btn btn-primary btn-sm">
                                        Details
                                 </button></a></td>
                            </tr>  
                               ';
                        } 
                        {
                            $x[] = $fuelleList2[$i]["PKAufgabenID"];
                        }
                    }
                    if (isset($x)) {
                        $y = count($x);
                    } 
                    
                    else {
                        $y = 0;
                    }
                    for ($i = 0; $i < $y; $i++) {
                        if (isset($_SESSION["start$i"]) && ($_SESSION["stop$i"])) {
                            $interval = strtotime($_SESSION["stop$i"]) - strtotime($_SESSION["start$i"]);
                            if ($interval > 0 && $interval < 43200) {
                                echo "Die Bearbeitungszeit für <b>ID " . $fuelleList2[$i]["PKAufgabenID"] . "</b> betrug<b> " . $interval . "</b> Sekunden";
                                $updateZeit = $meinObjekt->updateZeit($fuelleList2[$i]["PKAufgabenID"], $_SESSION["ID"], $interval);
                                $_SESSION["stop$i"] = "";
                                $_SESSION["start$i"] = "";
                            } else {
                                echo "";
                            }
                        } else {
                            echo "";
                        }
                    }
                    ?>  
                </table>  
            </div>  
        </div>
    </body>  
    <script>
        $(document).ready(function () {
            $('#tabledata,#tabledata1').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
                }
            });

        });
    </script>
</html>  