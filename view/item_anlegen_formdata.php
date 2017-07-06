<?php

session_start();
require_once '../controller/controller.php';

$meinObjekt = new Controller();

                $projekt = $_POST['projekt'];
                $deadline = $_POST['deadline'];
                $beschreibung = $_POST['beschreibung'];
                $erstell = date("Y-m-d h:i:sa");
                $_SESSION["ID"];


if (isset($projekt ) && !empty($deadline) && isset($_SESSION["ID"])) {
        
  
  $abfrage = $meinObjekt->getNeuesProjekt($projekt, $deadline, $erstell, $beschreibung); // neues Projekt in der Datenbanktabelle "Projekt" erstellen 
                       
        echo "1";
    } else {
        echo "0";
    }
    
    
