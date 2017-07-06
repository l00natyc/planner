<?php

session_start();
require_once '../controller/controller.php';

$meinObjekt = new Controller();

$user = $meinObjekt->getBenutzerByUsername($_POST["username"]);
if (isset($user) && !empty($user)) {
        
    if ($_POST["passwort"] == $user[0]["passwort"]) {
        $_SESSION["username"] = $user[0]["username"];
        $_SESSION["ID"] = $user[0]["PKMitarbeiterID"];
        $_SESSION["vorname"] = $user[0]["vorname"];
        $_SESSION["nachname"] = $user[0]["nachname"];
                       
        echo "1";
    } else {
        echo "0";
    }
}