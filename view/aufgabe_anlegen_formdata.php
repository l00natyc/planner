<?php

session_start();
require_once '../controller/controller.php';

$meinObjekt = new Controller();

                $aufgabenname = $_POST['projekt'];
                $beschreibung = $_POST['beschreibung'];
                $status = $_POST['status'];
            
                $datum = date('Y-m-d H:i:s');
                $_SESSION["ID"];


if (isset($aufgabenname)  && isset($_SESSION["ID"])) {
        
  
  $meinObjekt->getNeueAufgabe($aufgabenname, $status, $beschreibung,$datum); // neues Projekt in der Datenbanktabelle "Projekt" erstellen 
  
  $lastID = $meinObjekt->getLetzteID(); // hole die letzte Aufgaben ID
  
  $meinObjekt->updateZeit($lastID[0]["maxID"], $_SESSION["ID"], NULL); 
                       
        echo "1";
    } else {
        echo "0";
    }
    
    
