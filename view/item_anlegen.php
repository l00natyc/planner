<?php
session_start();
require_once '../controller/controller.php';
$gespeicherteID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$meinObjekt = new Controller();

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
        jQuery(document).on('submit', 'form', function (event) {
            event.preventDefault(); //Unterbrechen der Standardfunktion
            var data = new FormData(jQuery(this).get(0));
            // SEND DATA TO SERVER 
            console.log(data);
            jQuery.ajax({
                url: "item_anlegen_formdata.php",
                method: 'POST',
                processData: false,
                contentType: false,
                data: data,
                success: function (result) {
                    switch (result) {
                        case '0':
                        {
                            alert("Keine Daten eingetragen!");
                            break;
                        }//case error/failure
                        case '1':
                        {
                            alert("Daten erfolgreich eingetragen!");
                            location.reload();
                            break;
                        }//case success
                        default:
                        {
                            break;
                        }//case validation fail
                    }//switch result
                }

            });//ajax request
        });

    </script>
    <body>  
        <br /><br />  
        <div class="container">  
            <?php require_once 'navbar.php'; ?>
            <h3 align="center">Neues Projekte anlegen</h3>  
            <form action='#' method="post">
                <div class="form-group">
                    <label for="example-datetime-local-input" class="col-2 col-form-label">Projektname</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="usr" name="projekt" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="example-datetime-local-input" class="col-2 col-form-label">Deadline</label>
                    <div class="col-10">
                        <input class="form-control" type="datetime-local" name="deadline" value="" id="example-datetime-local-input">
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleSelect1">Example select</label>
                    <select class="form-control" id="exampleSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <!--                <div class="form-group">
                                    <label for="exampleSelect2">Example multiple select</label>
                                    <select multiple class="form-control" id="exampleSelect2">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>-->
                <div class="form-group">
                    <label for="exampleTextarea">Beschreibung / Bemerkung</label>
                    <textarea class="form-control" name="beschreibung" id="exampleTextarea" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">abschicken</button>
            </form>


        </div>
    </body>
</html>