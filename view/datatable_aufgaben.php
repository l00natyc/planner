<?php
session_start();
require_once '../controller/controller.php';
$meinObjekt = new Controller();
$fuelleList = $meinObjekt->ausgabeAlleAufgaben();
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
        <style>



        </style>
    </head>  
    <body>  

        <?php
        if (isSet($_SESSION["username"])) {

            echo "<div class=\"login\">Angemeldeter User: <strong>" . $_SESSION["username"] . " User ID: " . $_SESSION["ID"] . "</strong></div>";
        } else {
            echo "<div class=\"login\">Sie sind noch nicht angemeldet <a href=\"start.php\"><strong>login</strong></a> or <a href=\"register.php\"><strong>create an account</strong></a></div>";
        }
        echo '<p style="text-align: center"><a href="logout.php" tite="Logout">Logout</a></p>';
        ?>
        <br /><br />  
        <div class="container">  
            <h3 align="center">Übersicht aller derzeitigen Aufgaben</h3>  
            <br />  
            <div class="table-responsive">  
                <table id="tabledata" class="table table-striped table-bordered">  
                    <thead>  
                        <tr>  
                            <td>Projekt</td>  
                            <td>Aufgabe</td>  
                            <td>Mitarbeiter</td>  
                            <td>Status</td>  
                            <td>Auswahl</td>  
                        </tr>  
                    </thead>  
                    <?php
                    $max = count($fuelleList);


                    for ($i = 0; $i < $max; $i++) {

                        if ($fuelleList[$i]["status"] == 0) {
                            $status[$i] = "inaktiv";
                        } elseif
                        ($fuelleList[$i]["status"] == 1) {
                            $status[$i] = "aktiv";
                        } else {
                            $status[$i] = "anders";
                        }

                        echo '    
                               <tr>  
                                    <td>' . $fuelleList[$i]["projektname"] . '</td> 
                                    <td>' . $fuelleList[$i]["aufgabenname"] . '</td>  
                                    <td>' . $fuelleList[$i]["nachname"] . '</td>  
                                    <td>' . $status[$i] . '</td>  
                                    <td><button type="button" id="auswahl' . $i . '" class="btn btn-primary btn-sm">Auswahl</button>
                            </td>
                               
                               </tr>   
                               ';
                    }
                    ?>  
                </table>  
            </div>  
        </div>  
    </body>  
    <script>

        $(document).ready(function () {
            $('#tabledata').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
                }
            });
        });

    </script>
</html>  
