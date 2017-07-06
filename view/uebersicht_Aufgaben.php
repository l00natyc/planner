<?php
session_start();
require_once '../controller/controller.php';
$meinObjekt = new Controller(); // neues Objekt der Klasse Controller instanzieren
$fuelleList = $meinObjekt->getAlleAufgaben();  //Methode ausgabeAlleProjekte() 
print_r($fuelleList);
?>

<?php
if (isSet($_SESSION["username"])) {

    echo "<div class=\"login\">Angemeldeter User: <strong>" . $_SESSION["username"] . " User ID: " . $_SESSION["ID"] . "</strong></div>";
} else {
    echo "<div class=\"login\">Sie sind noch nicht angemeldet <a href=\"start.php\"><strong>login</strong></a> or <a href=\"register.php\"><strong>create an account</strong></a></div>";
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
            <h3 align="center">Übersicht aller Aufgaben</h3>  
            <br />  
            <div class="table-responsive">  
                <table id="tabledata" class="table table-striped table-bordered">  
                    <thead>  
                        <tr>  
                            <td>Aufgabenname</td>  
                            <td>AufgabenID</td>  
                            <td>User</td>  
                            <td>status</td>
                             <td>Erstelldatum</td>
                             <td>Beschreibung</td>
                      
                        
                        </tr>  
                    </thead>  
<?php
$max = count($fuelleList);

for ($i = 0; $i < $max; $i++) {

    $projektID[$i] = $fuelleList[$i]["fkaufgabenid"]; //speichere die Projekt ID im 
    echo '  
                               <tr>  
                                 <td>' . $fuelleList[$i]["aufgabenname"] . '</td> 
                                 <td>' . $fuelleList[$i]["fkaufgabenid"] . '</td>  
                                 <td>' . $fuelleList[$i]["username"] . '</td>  
                                 <td>' . $fuelleList[$i]["status"] . '</td>  
                                 <td>' . $fuelleList[$i]["erstelldatum"] . '</td>  
                                 <td>' . $fuelleList[$i]["beschreibung"] . '</td>  
                       
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
            $('#tabledata,#tabledata1').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
                }
            });

        });

    </script>


</html>  
