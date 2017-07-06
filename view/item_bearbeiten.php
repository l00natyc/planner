<?php
session_start();
require_once '../controller/controller.php';
$gespeicherteID = $_GET["id"];
$_SESSION["id_mitarbeiter"] = $gespeicherteID;
$meinObjekt = new Controller();
$fuelleList = $meinObjekt->getAufgabeByID($gespeicherteID);




if (isSet($_SESSION["username"])) {
    echo "<div class=\"login\">Angemeldeter User: <strong>" . $_SESSION["username"] . " User ID: " . $_SESSION["ID"] . "</strong></div>";
} else {
    echo "<div class=\"login\">Sie sind noch nicht angemeldet <a href=\"main.php\"><strong>login</strong></a> or <a href=\"register.php\"><strong>create an account</strong></a></div>";
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
    <script>
        $('.dropdown-menu li').click(function (e) {
            e.preventDefault();
            var selected = $(this).text();
            $('.box').val(selected);

        });

        jQuery(document).on('submit', 'form', function (event) {
            event.preventDefault(); //Unterbrechen der Standardfunktion
            var data = new FormData(jQuery(this).get(0));
            // SEND DATA TO SERVER 
            console.log(data);
            jQuery.ajax({
                url: "item_bearbeiten_formdata.php",
                method: 'POST',
                processData: false,
                contentType: false,
                data: data,
                success: function (result) {
                    switch (result) {
                        case '0':
                        {
                            alert("Update nicht erfolgreich!");
                            break;
                        }//case error/failure
                        case '1':
                        {
                            alert("Update erfolgreich!");
                        
                            break;
                        }//case success
                        default:
                        {
                            break;
                        }//case validation fail
                    }//switch result
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                }
            });//ajax request
        });

    </script>
    <body>  
        <br /><br />  


        <div class="container">  

            <?php require_once 'navbar.php'; ?>
            <form action='#' method="post">
                <div class="form-group">
                    <label for="usr">Aufgabenname:</label>
                    <input type="text" class="form-control" id="usr" name="name" value="<?php echo $fuelleList[0]["aufgabenname"] ?>">
                </div>


                <div class="form-group">
                    <label for="usr">Status:</label>
                    <input type="text" class="form-control" id="usr" name="status" value="<?php echo $fuelleList[0]["status"] ?>">
                </div>

                <div class="form-group">
                    <label for="usr">Beschreibung:</label>
                    <input type="text" class="form-control" id="usr" name="beschreibung" value="<?php echo $fuelleList[0]["beschreibung"] ?>">
                </div>

                <div class="form-group">
                    <label for="usr">ID:</label>
                    <input type="text" class="form-control" id="usr" name="aufgabenid" value="<?php echo $fuelleList[0]["PKAufgabenID"] ?>" disabled>
                </div>

                <button type="submit" class="btn btn-primary">abschicken</button>
            </form>


        </div>
    </body>
</html>