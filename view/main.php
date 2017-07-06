<?php
session_start();
if (isset($_SESSION) && !empty($_SESSION)) {
    print_r($_SESSION["username"]);
    header('Location: datatable_uebersicht.php');
}

require_once '../controller/controller.php';

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
        <style>

            hr {  height: 12px; border: 0; box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5); }
            /*            body {  background: blue;  For browsers that do not support gradients 
                                background: -webkit-linear-gradient(left,rgba(255,0,0,0),rgb(0,0,255)); Safari 5.1-6
                                background: -o-linear-gradient(right,rgba(255,0,0,0),rgb(0,0,255)); Opera 11.1-12
                                background: -moz-linear-gradient(right,rgba(255,0,0,0),rgb(0,0,255)); Fx 3.6-15
                                background: linear-gradient(to right, rgba(255,0,0,0), rgb(0,0,255)); Standard*/
            /*            }*/

        </style>
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
                    url: "login.php",
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function (result) {
                        switch (result) {
                            case '0':
                            {
                                alert("Passwort ist falsch!");
                                break;
                            }//case error/failure
                            case '1':
                            {
                                alert("Viel Spaß!");
                                location.reload();

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
    </head>
    <body>
        <div class="container">
            <div class="well text-center">

                <h1>Zeiterfassung</h1>

                <p><?php
                    if (isset($_SESSION["username"])) {
                        echo '<a href="logout.php" title="Logout">Logout</a></p>';
                        echo "Angemeldet ist: <b>" . $_SESSION["username"] . "</b>";
                    } else {
                        echo '          <div class="container">


            <div class="col-sm-4 col-md-offset-4 well">
                <form class="form-inline" action="#" method="post">
                    <div class="input-group col-sm-8">
                        <input class="form-control box" value="" placeholder="Name" name="username" type="text">
                        <input class="form-control" value="" placeholder="Passwort" name="passwort" type="password">
                        <div class="input-group-btn">

                            <input name="category" class="category" type="hidden">

                        </div><!-- /btn-group -->
                    </div>
                    <button class="btn btn-primary col-sm-3 pull-right" type="submit">Login</button>
                </form>
            </div>
        </div>
';
                    }
                    ?></p>
            </div>

        </ul>
    </div>
</body>
</html>

